'use strict';
/**
 * APPLICATION JAVASCRIPT
 *
 * base JavaScript entry point
 * utilises webpack for dependency management
 */

import 'polyfills/promise';

/**
 * BROWSER SUPPORT TEST
 * 
 * determines browser support for various features
 * add to the conditional as required to add additional
 * polyfills
 */
function browserSupportsAllFeatures() {
    return window.fetch;
}

/**
 * BOOT
 * 
 * requires and initialises the main JavaScript 
 * not this is not a async request. The `main.js` is inlined
 * within this function at compile time so that we can choose when 
 * it is initialised
 */
function boot() {
    require('./main');
}

// Determine whether to load polyfills or not...
if (!browserSupportsAllFeatures()) {
    import(/* webpackChunkName: "app-polyfills" */ './polyfills').then(function(
        polyfills
    ) {
        boot(); // then initialise main file
    });
} else {
    boot();
}
