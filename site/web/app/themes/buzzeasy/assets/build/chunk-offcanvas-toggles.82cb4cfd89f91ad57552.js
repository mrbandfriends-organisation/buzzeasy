webpackJsonp([2],{27:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=s(32);new n.a},32:function(t,e,s){"use strict";function n(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var i=s(0),a=s.n(i),r=s(5),o=s.n(r),l=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var s=arguments[e];for(var n in s)Object.prototype.hasOwnProperty.call(s,n)&&(t[n]=s[n])}return t},c=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),h=function(){function t(e){n(this,t);var s={wrapper:".js-offcanvas__wrapper",menu:".js-primary-offcanvas",toggleElements:".js-offcanvas-toggle",activeLeftClass:"is-active-left",activeRightClass:"is-active-right"};this.settings=l({},s,e),this.$root=a()(":root"),this.$menu=a()(this.settings.menu),this.$wrapper=a()(this.settings.wrapper),this.$toggleElements=a()(this.settings.toggleElements),this.state="closed",this.init()}return c(t,[{key:"init",value:function(){this.addListeners()}},{key:"addListeners",value:function(){this.$root.on("click",this.settings.toggleElements,this._handleToggle.bind(this))}},{key:"_handleToggle",value:function(t){t.preventDefault(),"closed"===this.state?this.open():this.close()}},{key:"open",value:function(){this.$wrapper.addClass(this.settings.activeRightClass),this.$menu.attr("aria-hidden","false"),this.$toggleElements.attr("aria-expanded","true"),this.state="open",o.a.publish("offcanvastoggler:opened")}},{key:"close",value:function(){this.$wrapper.removeClass(this.settings.activeRightClass),this.$menu.attr("aria-hidden","true"),this.$toggleElements.attr("aria-expanded","false"),this.state="closed",o.a.publish("offcanvastoggler:closed")}}]),t}();e.a=h}});