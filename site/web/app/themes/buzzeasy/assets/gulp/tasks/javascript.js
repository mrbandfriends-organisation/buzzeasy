// # JAVASCRIPT
// ==========================================================================

var gulp = require('gulp');
var plumber = require('gulp-plumber');
var eslint = require('gulp-eslint');
var webpack = require('webpack');
var gulpWebpack = require('webpack-stream');
var mocha = require('gulp-mocha');
var errorHandler = require('../errorHandler');
var paths = require('../paths');
var webpackConfig = require(paths.js.webpackConfig);
var Server = require('karma').Server;

// # JAVASCRIPT
gulp.task('javascripts', ['eslint'], function() {
    return gulp
        .src(paths.js.source)
        .pipe(
            plumber({
                errorHandler: errorHandler
            })
        )
        .pipe(gulpWebpack(webpackConfig, webpack)) // 2nd argument allows us to inject a custom version of webpack into the webpack-stream lib
        .pipe(gulp.dest(paths.js.output));
});

// # JSMIN
gulp.task('js-min', function() {
    return gulp
        .src(paths.js.source)
        .pipe(
            plumber({
                errorHandler: errorHandler
            })
        )
        .pipe(gulpWebpack(webpackConfig, webpack)) // 2nd argument allows us to inject a custom version of webpack into the webpack-stream lib
        .pipe(gulp.dest(paths.build_dir));
});

// # JSHINT
gulp.task('eslint', () => {
    return (
        gulp
            .src(paths.js.watch)
            .pipe(
                plumber({
                    errorHandler: errorHandler
                })
            )
            .pipe(eslint({}))
            // eslint.format() outputs the lint results to the console.
            .pipe(eslint.format())
    );
});

// # KARMA TEST RUNNER (SINGLE RUN)
gulp.task('karma', function(done) {
    new Server(
        {
            configFile: paths.js.karmaConfig,
            singleRun: true,
            autoWatch: false
        },
        done
    ).start();
});

// # KARMA TEST RUNNER (WATCH MODE)
gulp.task('karma:watch', function(done) {
    new Server(
        {
            configFile: paths.js.karmaConfig,
            singleRun: false,
            autoWatch: true
        },
        done
    ).start();
});

gulp.task('js-watch', ['javascripts']);
gulp.task('js-build', ['js-min']);
