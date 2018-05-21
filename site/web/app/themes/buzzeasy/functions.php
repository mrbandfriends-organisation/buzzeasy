<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

$sage_includes = [
  'lib/',
];

// If file is a directory, recursively iterate over all contents of it and
// require_once all contents with the .php. If its a file, just require_once it.

foreach ($sage_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    if (is_dir($filepath)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($filepath)
        );

        $files = new RegexIterator($iterator, '/^.+\.php$/', RecursiveRegexIterator::GET_MATCH);

        foreach ($files as $file) {
            require_once $file[0];
        }
    } else {
        require_once $filepath;
    }
}

unset($file, $filepath, $iterator);






// TESTING PURPOSES ONLY

// For our boilerplate theme to work you need to set the WP_ENV.
// This is normally done via Roots.io Bedrock but if you are not using
// a Bedrock setup then you need to hard code this value in.
// define('WP_ENV', 'development');
