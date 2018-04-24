webpackJsonp([2],{

/***/ 27:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_offcanvas_toggler__ = __webpack_require__(32);


/**
 * OFFCANVASES
 * manages the toggling of off canvas menu
 */

// Class



// Instances
var primaryOffCanvasToggle = new __WEBPACK_IMPORTED_MODULE_0_lib_offcanvas_toggler__["a" /* default */]();

/***/ }),

/***/ 32:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_pubsub_js__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_pubsub_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_pubsub_js__);

/**
 * OFFCANVAS TOGGLER
 * manages toggling of offcanvas elements
 */

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var OffCanvasToggler = function () {
    function OffCanvasToggler(options) {
        _classCallCheck(this, OffCanvasToggler);

        var defaults = {
            wrapper: '.js-offcanvas__wrapper',
            menu: '.js-primary-offcanvas',
            toggleElements: '.js-offcanvas-toggle',
            activeLeftClass: 'is-active-left',
            activeRightClass: 'is-active-right'
        };

        this.settings = _extends({}, defaults, options);

        this.$root = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(':root');
        this.$menu = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(this.settings.menu);
        this.$wrapper = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(this.settings.wrapper);
        this.$toggleElements = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(this.settings.toggleElements);

        this.state = 'closed';

        this.init();
    }

    _createClass(OffCanvasToggler, [{
        key: 'init',
        value: function init() {
            this.addListeners();
        }
    }, {
        key: 'addListeners',
        value: function addListeners() {
            this.$root.on('click', this.settings.toggleElements, this._handleToggle.bind(this) // required to ensure correct 'this' inside handler
            );
        }

        /**
         * Handle Toggle
         * evaluates current offcanvas state and delegates to
         * handler methods to open/close as required
         */

    }, {
        key: '_handleToggle',
        value: function _handleToggle(event) {
            event.preventDefault();

            if (this.state === 'closed') {
                this.open();
            } else {
                this.close();
            }
        }
    }, {
        key: 'open',
        value: function open() {
            this.$wrapper.addClass(this.settings.activeRightClass);
            this.$menu.attr('aria-hidden', 'false');
            this.$toggleElements.attr('aria-expanded', 'true');
            this.state = 'open';

            __WEBPACK_IMPORTED_MODULE_1_pubsub_js___default.a.publish('offcanvastoggler:opened');
        }
    }, {
        key: 'close',
        value: function close() {
            this.$wrapper.removeClass(this.settings.activeRightClass);
            this.$menu.attr('aria-hidden', 'true');
            this.$toggleElements.attr('aria-expanded', 'false');
            this.state = 'closed';

            __WEBPACK_IMPORTED_MODULE_1_pubsub_js___default.a.publish('offcanvastoggler:closed');
        }
    }]);

    return OffCanvasToggler;
}();

/* harmony default export */ __webpack_exports__["a"] = (OffCanvasToggler);

/***/ })

});