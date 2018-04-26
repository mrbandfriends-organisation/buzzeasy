'use strict';
/**
 * OFFCANVAS TOGGLER
 * manages toggling of offcanvas elements
 */

import $ from 'jquery';
import EventBus from 'pubsub-js';

class OffCanvasToggler {
    constructor(options) {
        const defaults = {
            wrapper: '.js-offcanvas__wrapper',
            menu: '.js-primary-offcanvas',
            toggleElements: '.js-offcanvas-toggle',
            activeClass: 'is-active'
        };

        this.settings = Object.assign({}, defaults, options);

        this.$root = $(':root');
        this.$menu = $(this.settings.menu);
        this.$wrapper = $(this.settings.wrapper);
        this.$toggleElements = $(this.settings.toggleElements);

        this.state = 'closed';

        this.init();
    }

    init() {
        this.addListeners();
    }

    addListeners() {
        this.$root.on(
            'click',
            this.settings.toggleElements,
            this._handleToggle.bind(this) // required to ensure correct 'this' inside handler
        );
    }

    /**
     * Handle Toggle
     * evaluates current offcanvas state and delegates to
     * handler methods to open/close as required
     */
    _handleToggle(event) {
        event.preventDefault();

        if (this.state === 'closed') {
            this.open();
        } else {
            this.close();
        }
    }

    open() {
        this.$wrapper.addClass(this.settings.activeClass);
        this.$menu.attr('aria-hidden', 'false');
        this.$toggleElements.attr('aria-expanded', 'true');
        this.state = 'open';

        EventBus.publish('offcanvastoggler:opened');
    }

    close() {
        this.$wrapper.removeClass(this.settings.activeClass);
        this.$menu.attr('aria-hidden', 'true');
        this.$toggleElements.attr('aria-expanded', 'false');
        this.state = 'closed';

        EventBus.publish('offcanvastoggler:closed');
    }
}

export default OffCanvasToggler;
