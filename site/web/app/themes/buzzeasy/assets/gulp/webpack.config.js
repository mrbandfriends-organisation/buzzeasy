var webpack = require('webpack');
var CleanWebpackPlugin = require('clean-webpack-plugin');
var path = require('path');
var paths = require('./paths');
var BundleAnalyzerPlugin = require('webpack-bundle-analyzer')
    .BundleAnalyzerPlugin;
/**
 * BUILD PLUGINS ARRAY
 *
 * Dynamically construct the webpack Plugins array. This is
 * because we conditionally want to apply uglify only if we
 * are in build mode
 */
function buildPluginsArray() {
    var rtn = [
        new webpack.ProvidePlugin({
            // inject globals as required
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            'window.$': 'jquery'
        }),
        // Included by default in Webpack 2.0
        //new webpack.optimize.OccurrenceOrderPlugin(),
        new CleanWebpackPlugin(['dist'], {
            root: paths.js.root,
            verbose: true,
            dry: false
        })
        //new BundleAnalyzerPlugin()
    ];

    if (process.env.NODE_ENV === 'production') {
        rtn.push(
            new webpack.optimize.UglifyJsPlugin({
                compressor: {
                    warnings: false
                }
            })
        );
    }

    return rtn;
}

function buildPublicPath() {
    var path = paths.js.output_uri;

    if (process.env.NODE_ENV === 'production') {
        path = paths.build_uri; // ensure chunks are loaded from the build dir
    }

    return path;
}

var plugins = buildPluginsArray();
var publicPath = buildPublicPath();

module.exports = {
    // webpack-stream for using Webpack with Gulp streams
    entry: paths.js.compile,
    output: {
        publicPath: publicPath, // used to define where to load chunks from...
        filename: '[name].js',
        chunkFilename: 'chunk-[name].[chunkhash].js' // generate one hash per chunk to enable cache busting on change
    },
    plugins: plugins,
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: [['es2015', { modules: false }]],
                            plugins: [
                                'transform-object-assign',
                                'syntax-dynamic-import'
                            ]
                        }
                    }
                ]
            }
        ]
    },
    amd: {
        jQuery: true
    },
    resolve: {
        alias: {
            // jquery: 'jquery/src/jquery'
            jquery: 'jquery-slim',
            behaviours: paths.js.sourceDir + '/behaviours/',
            lib: paths.js.sourceDir + '/lib/',
            ext: paths.js.sourceDir + '/ext/',
            polyfills: paths.js.sourceDir + '/polyfills/',
            'third-party': paths.js.sourceDir + '/third-party/'
        },
        modules: [paths.js.sourceDir, 'node_modules']
    }
};
