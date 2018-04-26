'use strict';
/**
 * NPM SCRIPTS
 * any node modules from npm
 */
// import jQuery from 'jquery';
import jQuery from 'jquery-slim'; // excludes ajax and effects modules if you need these please also update alias refs in webpack.config.js
import 'third-party/lazysizes-bgset';
import 'third-party/lazysizes-bgset-polyfill';
import 'third-party/modernizr';
import 'lazysizes';

/**
 * LIBS
 * core functionality libraries. Typically high level
 * abstractions or modules which should be involked by
 * particular behaviours
 */

import bpm from 'lib/breakpoint-manager';
import EventBus from 'lib/eventbus';

/**
 * BEHAVIOURS
 * bespoke JS components and behaviours. Commonly
 * these will utilise one or more modules from "lib"
 * as the basis for functionality
 */

// Non-conditional Behaviours
import 'behaviours/webfonts';
import 'behaviours/svg-sprites';
import 'behaviours/responsive-img-bgs';
import 'behaviours/offcanvases';

// OPTIONAL BEHAVIOURS
// import 'behaviours/accordion';
// import 'behaviours/carousels';
// import 'behaviours/default-tabs';
// import 'behaviours/inview';
// import 'behaviours/smooth-scroll';
// import 'behaviours/toggler';

// Conditional Behaviours
// https://webpack.js.org/guides/code-splitting-async/

if (document.querySelectorAll('.js-inline-video').length) {
    import(/* webpackChunkName: "inline-videos" */ 'behaviours/inline-video');
}

if (document.querySelectorAll('.js-background-video').length) {
    import(
        /* webpackChunkName: "background-videos" */ 'behaviours/background-video'
    );
}
