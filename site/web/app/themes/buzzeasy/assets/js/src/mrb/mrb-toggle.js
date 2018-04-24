// jshint strict:false
/**
 * TOGGLE
 *
 * Creates a Toogle switch used for triggering the addition of
 * "active"-like classes to another targetted DOM element
 * typically used to trigger visibility of expandable regions
 * such as toggleable menus. Works well when paired with a CSS
 * "expandable" module. Data API is provided.
 */

class Toggle {
    constructor(el, options) {
        this.el = el;
        this.$el = $(el);
        this.isActive = false;

        // Options
        this.settings = Object.assign(
            {
                eventType: 'click',
                toggleTarget: this.$el.data('toggle-target'),
                focusTarget: false,
                classList: this.$el.data('toggle-classlist') || 'is-active',
                toggleActiveText: this.$el.data('toggle-active-text') || false,
                autoHide: this.$el.data('toggle-autohide') || false
            },
            options
        );

        // Derived properties
        this.$toggleTarget = $(this.settings.toggleTarget);
        this.$focusTarget = this.settings.focusTarget
            ? $(this.settings.focusTarget)
            : this.$toggleTarget;
        this.toggleText = this.$el.text();

        // Boot
        if (this.$toggleTarget.length) {
            this.init();
        }
    }

    init() {
        this.addListeners();

        if (this.settings.autoHide) {
            this.$toggleTarget.hide();
        }
    }

    addListeners() {
        this.$el.on(this.settings.eventType, this.el, e => {
            e.preventDefault();
            this.toggleIt($(this));
        });
    }

    toggleIt($ele) {
        if (this.isActive) {
            this.close($ele);
        } else {
            this.open($ele);
        }
    }

    close($ele) {
        this.$toggleTarget.removeClass(this.settings.classList);
        this.$toggleTarget.attr('aria-hidden', 'true');

        if (this.settings.autoHide) {
            this.$toggleTarget.hide();
        }

        this.$el.removeClass('toggle--active');
        this.$focusTarget.attr('tabindex', '-1');
        this.$el.focus();

        if (this.settings.toggleActiveText) {
            this.$el.html(this.toggleText);
        }

        this.isActive = false;
    }

    open($ele) {
        this.$toggleTarget.addClass(this.settings.classList);
        this.$toggleTarget.attr('aria-hidden', 'false');

        if (this.settings.autoHide) {
            this.$toggleTarget.show();
        }

        this.$focusTarget.attr('tabindex', '0').focus();

        this.$el.addClass('toggle--active');

        if (this.settings.toggleActiveText) {
            this.$el.html(this.settings.toggleActiveText);
        }

        this.isActive = true;
    }
}

// API
$('.js-toggle').each(function() {
    var $this = $(this);

    // Check if this has been initialized
    if ($this.data('mrb-module-initialized')) {
        return true;
    }

    // Mark as initialized
    $this.data('mrb-module-initialized', true);

    // Instantiate new SmoothScroll on this unique element
    new Toggle($this);
});

// Export
export default Toggle;
