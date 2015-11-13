'use strict';

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
const browserSync = require('browser-sync').create();
const webpack = require('webpack');

const webpackConfig = require('./webpack.config.js');
/**
 * Clean
 */
const folderToClean = [
    'public/assets/web'
];

gulp.task('clean', function() {
    return gulp.src(folderToClean, {
            read: false
        })
        .pipe(rimraf());
});


/**
 * Copy assets
 */
const filesToMove = {
    input: [
        'resources/assets/img/**/*.*',
        'resources/assets/fonts/**/*.*',
        '!resources/assets/fonts/icomoon/**/*.*'
    ],
    output: 'public/assets/web',
    base: 'resources/assets'
};

const icoFontsToMove = {
    input: 'resources/assets/fonts/icomoon/dist/fonts/*.*',
    base: 'resources/assets/fonts/icomoon/dist/fonts',
    output: 'public/assets/web/fonts/'
};

gulp.task('copy', ['clean'], function() {
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

gulp.task('css:dev', function() {
    return gulp.src(styleToProcess.input)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(stylecow(merge({}, styleCowOptions, {
            code: 'normal'
        })))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(styleToProcess.output))
        .pipe(browserSync.stream());
});

gulp.task('css:prod', function() {
    return gulp.src(styleToProcess.input)
        .pipe(sass().on('error', sass.logError))
        .pipe(stylecow(merge({}, styleCowOptions, {
            code: 'minify'
        })))
        .pipe(gulp.dest(styleToProcess.output));
});

/**
 * Build fonts
 */
const filesToProcess = {
    input: 'resources/assets/fonts/icomoon/dist/css/style.css',
    output: 'resources/assets/fonts/icomoon/'
};

gulp.task('fonts', function() {
    return gulp.src(filesToProcess.input)
        .pipe(replace(/url\('fonts\//ig, 'url(\'../fonts/'))
        .pipe(replace(/\[.*] {[\n\r]([^}]*[\n\r])*}/, '%icon {\n    &:before,\n    &:after{\n    $1}\n}'))
        .pipe(replace(/\.icon-(.*):before {[\n\r].*content: (.*);/ig, '$icon-var-$1: $2;\n%icon-$1 {\n    @extend %icon;\n    &:before {\n    content: $icon-var-$1;\n    }'))
        .pipe(rename('_icomoon.scss'))
        .pipe(gulp.dest(filesToProcess.output));
});


/**
 * Dev server && Watching
 */
const watchFiles = {
    css: 'resources/assets/sass/**/*.scss',
    views: 'resources/views/**/*.php',
    js: 'resources/assets/js/**/*.js'
};

gulp.task('dev-server', function() {
    browserSync.init({
        proxy: 'http://ans-template.dev',
        open: false
    });

    gulp.watch(watchFiles.css, ['css-dev']);
    gulp.watch(watchFiles.views).on('change', browserSync.reload);
    gulp.watch(watchFiles.js, ['webpack-watch']);

});


/**
 * Js
 */
gulp.task('webpack:prod', function(callback) {

    let buildConfig = Object.create(webpackConfig);

    buildConfig.plugins = buildConfig.plugins.concat(
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            },
            'PRODUCTION': true,
            'DEBUG': false
        }),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.UglifyJsPlugin()
    );

    webpack(buildConfig, function(err, stats) {
        if (err) {
            throw new gutil.PluginError('webpack:prod', err);
        }

        gutil.log('[webpack:prod]', stats.toString({
            colors: true
        }));

        callback();
    });
});

gulp.task('webpack:dev', function(callback) {

    const buildConfig = Object.create(webpackConfig);

    buildConfig.plugins = buildConfig.plugins.concat(
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            },
            'PRODUCTION': true,
            'DEBUG': false
        }),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.UglifyJsPlugin()
    );

    webpack(buildConfig, function(err, stats) {
        if (err) {
            throw new gutil.PluginError('webpack:build', err);
        }

        gutil.log('[webpack:build]', stats.toString({
            colors: true
        }));

        callback();
    });
});


const myDevConfig = Object.create(webpackConfig);
myDevConfig.devtool = 'sourcemap';
myDevConfig.debug = true;

var devCompiler = webpack(myDevConfig);

gulp.task('webpack:dev', function(callback) {
    devCompiler.run(function(err, stats) {
        if (err) {
            throw new gutil.PluginError('webpack:build-dev', err);
        }

        gutil.log('[webpack:dev]', stats.toString({
            colors: true
        }));

        callback();
    });
});

gulp.task('webpack-watch', ['webpack:dev'], browserSync.reload);

/**
 * Development task
 */
gulp.task('dev', ['clean', 'copy', 'fonts', 'css:dev', 'dev-server']);


/**
 * Default task
 */
gulp.task('default', ['clean', 'copy', 'fonts', 'css:prod']);
