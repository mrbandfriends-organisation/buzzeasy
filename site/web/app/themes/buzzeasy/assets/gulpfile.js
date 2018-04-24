/* jshint strict:false */

// ==========================================================================
// # DEPENDENCIES
// ==========================================================================

// gulp
var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// ==========================================================================
// # PATHS
// ==========================================================================

var paths = require('./gulp/paths');

// ==========================================================================
// # TASKS
// ==========================================================================

// include submodules
require('require-dir')('./gulp/tasks');

// # WATCH
// ==========================================================================
gulp.task('watch', function()
{
    gulp.watch([paths.sass.watch],  ['sass-watch']);
    gulp.watch([paths.js.watch],  ['js-watch']);
    gulp.watch([paths.svg.watch.sprite, paths.svg.watch.standalone], ['svg-watch']);
});

gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
});

gulp.task('default', ['watch']);


gulp.task('serve', ['browser-sync','sass-watch','js-watch', 'svg-watch', 'watch']);

// # Clean
// ==========================================================================
gulp.task('clean', function()
{
    require('del')( 'dist/**/*' );
});

// # BUILD
// ==========================================================================
gulp.task('build', function() {
    isBuild = true;

    // Run each task in sync (supposedly...not perfect but...)
    require('run-sequence')(
        'clean',
        'sass',
        'javascripts',
        'imagemin',
        'svg-watch',
        function()
        {
            // copy assets
            gulp.src([
                'assets/css/**/*',
                'assets/js/dist/**/*',
                'assets/fonts/**/*',
                'assets/images/**/*',
                'assets/svg/**/*'
            ], { base: 'assets' })
                .pipe(gulp.dest('./dist/assets'));
        }
    );
});