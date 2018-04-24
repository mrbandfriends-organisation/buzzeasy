var webpackConfig = require('./webpack.config');
var paths         = require('./paths');

module.exports = function (config) {
  config.set({
    basePath: '',
    frameworks: ['mocha', 'chai'],
    files: [
      paths.js.testFiles
    ],
    exclude: [
    ],
    preprocessors: {
        [paths.js.testFiles]: ['webpack'],
        '**/*.js': ['sourcemap']
        
    },
    webpack: { // pass through only the bits of the WP config you definately need for tests
      plugins: webpackConfig.plugins, 
      module: webpackConfig.module,
      resolve: webpackConfig.resolve
    },
    plugins: [
        require('karma-webpack'),
        require('karma-phantomjs-launcher'),
        require('karma-mocha'),
        require('karma-chai'),
        require('karma-nyan-reporter'),
        require('karma-sourcemap-loader')
    ],
    reporters: ['nyan'],
    port: 9876,
    colors: true,
    logLevel: config.LOG_INFO,
    autoWatch: true,
    browsers: ['PhantomJS'],
    // browsers: ['Chrome', 'Chrome_without_security'],
    // customLaunchers: {
    //   Chrome_without_security: {
    //     base: 'Chrome',
    //     flags: ['--disable-web-security']
    //   }
    // },
    singleRun: false,
    concurrency: Infinity
  })
}
