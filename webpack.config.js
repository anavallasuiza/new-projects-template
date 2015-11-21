const fs = require('fs');
const webpack = require('webpack');

const commonsPlugin = new webpack.optimize.CommonsChunkPlugin({
    name: 'common',
    filename: 'common.[hash].js',
    minChunks: 2
});

module.exports = (url) => {
    return {
        cache: true,
        entry: {
            main: './resources/assets/js/main.js'
        },
        output: {
            path: './public/assets/web/js',
            filename: '[name].[hash].js',
            publicPath: url + 'assets/web/js/',
            chunkFilename: '[id].[chunkhash].js'
        },
        resolve: {
            modulesDirectories: ['node_modules', 'web_modules', 'modules']
        },
        module: {
            loaders: [{
                test: /\.js$/,
                exclude: [/node_modules/, /web_modules/],
                loader: 'babel-loader',
                query: {
                    presets: ['es2015']
                }
            }]
        },
        plugins: [commonsPlugin,
            new webpack.ProvidePlugin({
                jQuery: 'jquery',
                $: 'jquery',
                'window.jQuery': 'jquery'
            }),
            new webpack.ResolverPlugin([
                new webpack.ResolverPlugin.DirectoryDescriptionFilePlugin('bower.json', ['main'])
            ]),
            function() {
                this.plugin('done', function(stats) {
                    fs.writeFileSync('./cache.json', JSON.stringify({
                        hash: stats.hash
                    }));
                });
            }
        ],
        node: {
            fs: 'empty'
        }
    };
};
