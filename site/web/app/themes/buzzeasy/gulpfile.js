// ==========================================================================
// # DEPENDENCIES
// ==========================================================================

var gulp            = require('gulp');
var rev             = require('gulp-rev');
var revdel          = require('gulp-rev-delete-original');
var runSequence     = require('run-sequence');
var errorHandler    = require('./assets/gulp/errorHandler');

require('frontend-boilerplate-assets');

// ==========================================================================
// # PATHS
// ==========================================================================

var paths = require('./assets/gulp/paths');


// ==========================================================================
// # TASKS
// ==========================================================================

// include submodules
require('require-dir')('./assets/gulp/tasks');

// # WATCH
// ==========================================================================
gulp.task('watch', ['sass','javascripts'], function()
{
    gulp.watch([paths.sass.watch],  ['sass-watch']);
    gulp.watch([paths.js.watch  ],  ['js-watch']);
    gulp.watch([paths.svg.watch.sprite, paths.svg.watch.standalone], ['svg-watch']);
});

gulp.task('default', ['watch']);


// # CLEAN
// ==========================================================================
gulp.task('clean-build', function()
{
    require('del')( paths.build_dir );
});

// FILE CACHE BUSTING (REV)
// ==========================================================================
gulp.task('rev', function() {
    return gulp.src([
        '!' + paths.build_dir + 'chunk-*.js', // don't rev files that have already been rev'd (by Webpack)
        paths.build_dir + '*' // rev all non-versioned files
    ])
    .pipe(rev()) // cache bust the filenames
    .pipe(revdel()) // remove original files once they have been cache busted
    .pipe(gulp.dest(paths.build_dir))
    .pipe(rev.manifest({
        path: 'manifest.json',
        merge: true
    }))
    .pipe(gulp.dest(paths.build_dir))
});

// BUILD
// creates files for Staging and Production envs
// ==========================================================================
gulp.task('build', function() {
    runSequence(
        'clean-build',
        ['js-build', 'css-build'],
        ['imagemin','svg-watch'],
        'rev'
    );
});
