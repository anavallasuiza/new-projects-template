'use strict';

const fs = require('fs');
const gulp = require('gulp');
const gutil = require('gulp-util');
const merge = require('merge');
const rimraf = require('gulp-rimraf');
const mergeStream = require('merge-stream');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const replace = require('gulp-replace');
const stylecow = require('gulp-stylecow');
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cached');
const browserSync = require('browser-sync').create();
const webpack = require('webpack');


/**
 * Config
 */
const config = require('./config.js');

// Handle local config files
if (fs.existsSync('./local.config.js')) {
    merge(config, require('./local.config.js'));
}

const webpackConfig = require('./webpack.config.js');

// Public folders
const publicFolders = {
    css: 'public/assets/web/css',
    img: 'public/assets/web/img',
    fonts: 'public/assets/web/fonts',
    js: 'public/assets/web/js'
};


/**
 * Fonts
 */
const filesToMove = {
    input: [
        'resources/assets/fonts/**/*.*',
        '!resources/assets/fonts/icomoon/**/*.*'
    ],
    output: 'public/assets/web',
    base: 'resources/assets'
};

const icoFontsToMove = {
    input: 'resources/assets/fonts/icomoon/fonts/*.*',
    base: 'resources/assets/fonts/icomoon/fonts',
    output: 'public/assets/web/fonts/'
};

gulp.task('clean:fonts', function() {
    return gulp.src(publicFolders.fonts, {
        read: false
    })
    .pipe(rimraf());
});

gulp.task('copy:fonts', ['clean:fonts'], function() {
    let files = gulp.src(filesToMove.input, {
        base: filesToMove.base
    })
    .pipe(gulp.dest(filesToMove.output));

    let icoFonts = gulp.src(icoFontsToMove.input, {
        base: icoFontsToMove.base
    })
    .pipe(gulp.dest(icoFontsToMove.output));

    return mergeStream(files, icoFonts);
});

const filesToProcess = {
    input: 'resources/assets/fonts/icomoon/style.css',
    output: 'resources/assets/fonts/icomoon/'
};

gulp.task('fonts', ['copy:fonts'], function() {
    return gulp.src(filesToProcess.input)
        .pipe(replace(/url\('fonts\//ig, 'url(\'../fonts/'))
        .pipe(replace(/\[.*] {[\n\r]([^}]*[\n\r])*}/, '%icon {\n    &:before,\n    &:after{\n    $1}\n}'))
        .pipe(replace(/\.icon-(.*):before {[\n\r]\s+content:\s+(.*);/ig, '$icon-var-$1: $2;\n%icon-$1 {\n    @extend %icon;\n    &:before {\n    content: $icon-var-$1;\n    }'))
        .pipe(rename('_icomoon.scss'))
        .pipe(gulp.dest(filesToProcess.output));
});


/**
 * CSS
 */
const styleToProcess = {
    input: 'resources/assets/sass/style.scss',
    output: 'public/assets/web/css'
};

const styleCowOptions = {
    'support': {
        'explorer': 10,
        'firefox': 30,
        'chrome': 35,
        'safari': 7,
        'opera': 22,
        'android': 4,
        'ios': 6
    },
    'plugins': [
        'fixes',
        'prefixes',
        'rem',
        'flex'
    ]
};

gulp.task('clean:css', function() {
    return gulp.src(publicFolders.css, {
        read: false
    })
    .pipe(rimraf());
});


gulp.task('css:dev', ['fonts', 'clean:css'], function() {
    return gulp.src(styleToProcess.input)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(stylecow(merge({}, styleCowOptions, {
            code: 'normal'
        })))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(styleToProcess.output))
        .pipe(browserSync.stream());
});

gulp.task('css:prod', ['fonts', 'clean:css'], function() {
    return gulp.src(styleToProcess.input)
        .pipe(sass().on('error', sass.logError))
        .pipe(stylecow(merge({}, styleCowOptions, {
            code: 'minify'
        })))
        .pipe(gulp.dest(styleToProcess.output));
});


/**
 * Images
 */
const imagesToProcess = {
    input: 'resources/assets/img/*.{jpg,png,gif,svg}',
    output: 'public/assets/web/img'
};


gulp.task('clean:img', function() {
    return gulp.src(publicFolders.img, {
        read: false
    })
    .pipe(rimraf());
});

gulp.task('images', ['clean:img'], function() {
    gulp.src(imagesToProcess.input)
        .pipe(cache('img'))
        .pipe(imagemin())
        .pipe(gulp.dest(imagesToProcess.output));
});


/**
 * Dev server && Watching
 */
const watchFiles = {
    css: 'resources/assets/sass/**/*.scss',
    views: 'resources/views/**/*.php',
    js: 'resources/assets/js/**/*.js',
    img: imagesToProcess.input
};

gulp.task('dev-server', function() {
    browserSync.init({
        proxy: config.projectURL,
        open: false
    });

    gulp.watch(watchFiles.css, ['css:dev']);
    gulp.watch(watchFiles.views).on('change', browserSync.reload);
    gulp.watch(watchFiles.img, ['images']);
    gulp.watch(watchFiles.js, ['webpack:watch']);

});


/**
 * Js
 */
gulp.task('clean:js', function() {
    return gulp.src(publicFolders.js, {
        read: false
    })
    .pipe(rimraf());
});

gulp.task('webpack:prod', ['clean:js'], function(callback) {

    let buildConfig = Object.create(webpackConfig(config.publicPath));

    buildConfig.plugins = buildConfig.plugins.concat(
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            },
            'PRODUCTION': true,
            'DEVELOPMENT': false
        }),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        })
    );

    webpack(buildConfig, function(err, stats) {
        if (err) {
            throw new gutil.PluginError('webpack:prod', err);
        }

        gutil.log('[webpack:prod]', stats.toString({
            colors: true
        }));

        return callback();
    });
});

const myDevConfig = Object.create(webpackConfig(config.publicPath));
myDevConfig.devtool = 'sourcemap';
myDevConfig.debug = true;

myDevConfig.plugins = myDevConfig.plugins.concat(
    new webpack.DefinePlugin({
        'PRODUCTION': false,
        'DEVELOPMENT': true
    })
);

var devCompiler = webpack(myDevConfig);

gulp.task('webpack:dev', function(callback) {
    return devCompiler.run(function(err, stats) {
        if (err) {
            throw new gutil.PluginError('webpack:dev', err);
        }

        gutil.log('[webpack:dev]', stats.toString({
            colors: true
        }));

        return callback();
    });
});


/**
 * Extra watchers
 */
gulp.task('webpack:watch', ['webpack:dev'], function() {
    browserSync.reload();
});


/**
 * Development task
 */
gulp.task('dev',['images', 'css:dev', 'clean:js', 'webpack:dev', 'dev-server']);

/**
 * Default task
 */
gulp.task('default', ['images', 'css:prod', 'webpack:prod']);
