webpackJsonp([0],{

/***/ 29:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_background_video__ = __webpack_require__(34);

/**
 * BACKGROUND VIDEO
 *
 */



var backgroundVideos = Array.from(document.querySelectorAll('.js-background-video'));

if (backgroundVideos.length) {
    backgroundVideos.forEach(function (video) {
        new __WEBPACK_IMPORTED_MODULE_0_lib_background_video__["a" /* default */](video);
    });
}

/***/ }),

/***/ 31:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (immutable) */ __webpack_exports__["a"] = applyMixins;


/**
 * APPLY MIXINS
 * accepts a target constructor and extends it's delegate prototype
 * with one or more mixin objects. This follows the best practice of
 * preferring object composition over class hierarchies
 */

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

function applyMixins(target) {
    for (var _len = arguments.length, mixins = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        mixins[_key - 1] = arguments[_key];
    }

    mixins.reduce(function (acc, mixin) {
        return _extends(acc, mixin);
    }, target.prototype);

    return target;
}

/***/ }),

/***/ 34:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_video_player__ = __webpack_require__(35);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lib_apply_mixins__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_lib_mixins_object_fit_video__ = __webpack_require__(38);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lib_delay__ = __webpack_require__(39);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }






var BackgroundVideo = function () {
    function BackgroundVideo(el, options) {
        _classCallCheck(this, BackgroundVideo);

        // Accept selector or existing Node ref
        this.el = el && el.nodeType ? el : document.querySelector(el);

        this.videoIsDirty = false;

        // Options
        this.settings = _extends({
            videoLoadTimeout: 3000,
            requiredBuffer: 3000,
            sources: ['mp4', 'webm']
        }, options);

        if (this.el) {
            this.init();
        }
    }

    _createClass(BackgroundVideo, [{
        key: 'init',
        value: function init() {
            this.addSources();

            this.initPlayer();

            // Loading kick off
            this.load();
        }
    }, {
        key: 'addSources',
        value: function addSources() {
            var _this2 = this;

            var fragment = document.createDocumentFragment();

            var sourceHtml = this.settings.sources.forEach(function (source) {
                var src = _this2.el.getAttribute('data-bgvideo-source-' + source);

                var sourceEl = document.createElement('source');
                sourceEl.setAttribute('type', 'video/' + source);
                sourceEl.setAttribute('src', src);
                fragment.appendChild(sourceEl);
            });

            this.el.querySelector('video').appendChild(fragment);
        }
    }, {
        key: 'load',
        value: function load() {
            var _this3 = this;

            this.player.startBuffering();

            Object(__WEBPACK_IMPORTED_MODULE_3_lib_delay__["a" /* default */])(this.settings.videoLoadTimeout).then(function () {
                // Video already active so don't do anything...
                if (_this3.videoIsDirty || _this3.player.isPlaying) {
                    return;
                }

                _this3.videoIsDirty = true; // video took too long so mark as "dirty"

                // ...and unload the video to cancel further download
                _this3.player.destroyVideo();
                _this3.player.destroyControls();
            });
        }
    }, {
        key: 'initPlayer',
        value: function initPlayer() {
            var _this = this;

            this.player = new __WEBPACK_IMPORTED_MODULE_0_lib_video_player__["a" /* default */](this.el, {
                onResize: function onResize(playerInstance) {
                    _this.objectFitVideo();
                },
                onProgress: function onProgress(playerInstance) {
                    _this.videoReady(playerInstance);
                },
                onLoadedMetaData: function onLoadedMetaData(playerInstance) {
                    _this.videoReady(playerInstance);
                }
            });
        }
    }, {
        key: 'videoReady',
        value: function videoReady(playerInstance) {
            var _this = this;
            if (!_this.videoIsDirty && playerInstance.bufferPos() > _this.settings.requiredBuffer / 1000) {
                // if we've buffered X seconds of video
                playerInstance.start();
                _this.videoIsDirty = true;
            }
        }
    }]);

    return BackgroundVideo;
}();

// Apply Mixins


Object(__WEBPACK_IMPORTED_MODULE_1_lib_apply_mixins__["a" /* default */])(BackgroundVideo, __WEBPACK_IMPORTED_MODULE_2_lib_mixins_object_fit_video__["a" /* default */]);

/* harmony default export */ __webpack_exports__["a"] = (BackgroundVideo);

/***/ }),

/***/ 35:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_apply_mixins__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lib_mixins_trigger_callback__ = __webpack_require__(36);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_lib_eventbus__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lib_logger__ = __webpack_require__(37);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * VIDEO MODULE
 *
 * The following comment sets elVideo to be a global variable, as it is not defined in this file.
 */
/* global elVideo */





var VideoPlayer = function () {
    function VideoPlayer(el, options) {
        _classCallCheck(this, VideoPlayer);

        this.el = el;
        this.isPlaying = false;
        this.onCanPlayThroughCalled = false;

        options = options || {};

        this.settings = _extends({
            videoEl: 'video',
            playEl: '.js-video-player-play',
            pauseEl: '.js-video-player-pause',
            toggleEl: '.js-video-player-toggle',
            fireCurrentTime: false,
            pauseOnPlayerClick: true,
            pauseOnResize: false
        }, options);

        // Derived selectors
        this.videoEl = this.el.querySelector(this.settings.videoEl);
        this.playEl = this.el.querySelector(this.settings.playEl);
        this.pauseEl = this.el.querySelector(this.settings.pauseEl);
        this.toggleEl = this.el.querySelector(this.settings.toggleEl);

        this.controls = [this.pauseEl, this.playEl, this.toggleEl];

        if (this.videoEl) {
            this.init();
        } else {
            Object(__WEBPACK_IMPORTED_MODULE_3_lib_logger__["a" /* default */])('Video Module: no videoEl detected');
        }
    }

    _createClass(VideoPlayer, [{
        key: 'init',
        value: function init() {
            this.addListeners();
        }
    }, {
        key: 'setNewVideo',
        value: function setNewVideo(newVideo) {
            this.videoEl.setAttribute('src', newVideo);
            this.videoEl.load();
        }
    }, {
        key: 'startBuffering',
        value: function startBuffering() {
            this.videoEl.preload = 'auto';
            this.videoEl.load();
        }
    }, {
        key: 'addListeners',
        value: function addListeners() {
            var _this2 = this;

            var _this = this;

            // Aways stop on resize because of tablet orientation change
            window.addEventListener('resize', function (e) {
                if (_this2.settings.pauseOnResize) {
                    _this2.stop();
                }

                _this2.triggerCallback('onResize');
            });

            // If another player starts playing then stop this one
            __WEBPACK_IMPORTED_MODULE_2_lib_eventbus__["a" /* default */].subscribe('video-player.playing', function (e, data) {
                if (data.module.el !== _this2.el) {
                    _this2.stop();
                }
            });

            if (this.playEl) {
                this.playEl.addEventListener('click', function (e) {
                    e.preventDefault();
                    _this2.start();
                });
            }

            if (this.pauseEl) {
                this.pauseEl.addEventListener('click', function (e) {
                    e.preventDefault();
                    _this2.stop();
                });
            }

            if (this.toggleEl) {
                this.toggleEl.addEventListener('click', function (e) {
                    e.preventDefault();
                    _this2.toggleVideoPlayState();
                });
            }

            this.videoEl.addEventListener('loadedmetadata', function (e) {
                _this2.triggerCallback('onProgress');
            });

            this.videoEl.addEventListener('ended', function (e) {
                _this2.stop();
                _this2.triggerCallback('onEnd');
            });

            // Handle programmatic or toggle via DOM "controls"
            this.videoEl.addEventListener('pause', function (e) {
                _this2.stop({
                    preventRepeatEvent: true
                });
            });

            // Handle programmatic or toggle via DOM "controls"
            this.videoEl.addEventListener('play', function (e) {
                _this2.start({
                    preventRepeatEvent: true
                });
            });

            this.videoEl.addEventListener('canplaythrough', function (e) {
                if (!_this2.onCanPlayThroughCalled) {
                    _this2.triggerCallback('onCanPlayThrough');
                }

                _this2.onCanPlayThroughCalled = true;
            });

            if (this.settings.fireCurrentTime) {
                this.videoEl.addEventListener('timeupdate', function (event) {
                    var currentTime = _this2.currentTime;
                    var duration = _this2.duration;

                    _this2.triggerCallback('onVideoCurrentTimeUpdate', {
                        module: _this,
                        currentTime: currentTime,
                        duration: duration
                    });
                });
            }
        }
    }, {
        key: 'start',
        value: function start(args) {
            var _this = this;

            args = args || {};

            this.isPlaying = true;

            // Update classes
            this.el.classList.add('playing');
            this.el.classList.add('is-playing');
            this.el.classList.remove('is-paused');

            if (this.toggleEl) {
                this.toggleEl.textContent = 'Pause';
                this.toggleEl.classList.add('is-playing');
                this.toggleEl.classList.remove('is-paused');
            }

            this.addVideoEvents();

            if (args.preventRepeatEvent === undefined || !args.preventRepeatEvent) {
                // Get DOM video el and init play
                this._play();
            }

            // Trigger global event to tell other players to stop
            __WEBPACK_IMPORTED_MODULE_2_lib_eventbus__["a" /* default */].publish('video-player.playing', {
                module: _this
            });

            _this.triggerCallback('onStart');
        }
    }, {
        key: 'bufferPercentage',
        value: function bufferPercentage() {
            var vid = this.videoEl;

            var bufferedPercent = vid.duration > 0 && vid.buffered.length > 0 ? vid.buffered.end(0) / vid.duration * 100 : 0;

            return bufferedPercent;
        }
    }, {
        key: 'bufferPos',
        value: function bufferPos() {
            var videoEl = this.videoEl;
            var bufferedAmount = videoEl.duration > 0 && videoEl.buffered.length > 0 ? videoEl.buffered.end(0) : 0;
            return bufferedAmount;
        }
    }, {
        key: 'stop',
        value: function stop(args) {
            var _this = this;

            args = args || {};

            this.isPlaying = false;
            this.el.classList.remove('playing');
            this.el.classList.remove('is-playing');
            this.el.classList.add('is-paused');

            if (this.toggleEl) {
                this.toggleEl.textContent = 'Play';
                this.toggleEl.classList.remove('is-playing');
                this.toggleEl.classList.add('is-paused');
            }

            this.removeVideoEvents();

            if (args.preventRepeatEvent === undefined || !args.preventRepeatEvent) {
                // Get DOM video el and init pause
                this._pause();
            }

            this.triggerCallback('onStop');
        }
    }, {
        key: 'addVideoEvents',
        value: function addVideoEvents() {
            var handler = this.toggleVideoPlayState.bind(this);

            if (this.settings.pauseOnPlayerClick) {
                this.videoEl.addEventListener('click', handler);
            }
        }
    }, {
        key: 'toggleVideoPlayState',
        value: function toggleVideoPlayState() {
            if (this.isPlaying) {
                this.stop();
            } else {
                this.start();
            }
        }
    }, {
        key: 'removeVideoEvents',
        value: function removeVideoEvents() {
            var handler = this.toggleVideoPlayState.bind(this);

            this.videoEl.removeEventListener('click', handler);
        }
    }, {
        key: '_play',
        value: function _play() {
            // Get DOM video el and init play
            this.videoEl.play();
        }
    }, {
        key: '_pause',
        value: function _pause() {
            // Get DOM video el and init pause
            this.videoEl.pause();
        }
    }, {
        key: 'destroyVideo',
        value: function destroyVideo() {
            var video = this.videoEl;
            var tmp = video.src;

            this._pause();

            video.src = ''; // empty the video source first
            video.load(); // the load in the empty src which causes buffering to cease

            this.videoEl.remove(); // remove video entirely for good measure
        }
    }, {
        key: 'destroyControls',
        value: function destroyControls() {
            this.controls.forEach(function (control) {
                return control && control.remove();
            });
        }
    }]);

    return VideoPlayer;
}();

// Apply Mixins


Object(__WEBPACK_IMPORTED_MODULE_0_lib_apply_mixins__["a" /* default */])(VideoPlayer, __WEBPACK_IMPORTED_MODULE_1_lib_mixins_trigger_callback__["a" /* default */]);

// Export
/* harmony default export */ __webpack_exports__["a"] = (VideoPlayer);

/***/ }),

/***/ 36:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

/**
 * TRIGGER CALLBACK
 *
 * provides ability to trigger a named callback function which is passed in as a "setting"
 */

/* harmony default export */ __webpack_exports__["a"] = ({
    triggerCallback: function triggerCallback(eventName) {
        if (this.settings === undefined) {
            return;
        }

        if (this.settings[eventName] !== undefined && typeof this.settings[eventName] === 'function') {
            this.settings[eventName](this);
        }
    }
});

/***/ }),

/***/ 37:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var logger = function logger(data) {
    if (LOCALISED_VARS && LOCALISED_VARS.env !== 'production') {
        console.log(data); // eslint-disable-line no-console
    } else {
            // TODO - production logger
        }
};

/* harmony default export */ __webpack_exports__["a"] = (logger);

/***/ }),

/***/ 38:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";


/* harmony default export */ __webpack_exports__["a"] = ({
    objectFitVideo: function objectFitVideo() {
        // IE/Edge still don't support object-fit: cover
        if ('object-fit' in document.body.style) return;

        // Video's intrinsic dimensions
        var w = this.videoEl.videoWidth;
        var h = this.videoEl.videoHeight;
        var container = this.el;

        // Intrinsic ratio
        // Will be more than 1 if W > H and less if H > W
        var videoRatio = (w / h).toFixed(2);

        // Get the container DOM element and its styles
        //
        // Also calculate the min dimensions required (this will be
        // the container dimentions)
        var containerStyles = window.getComputedStyle(container);
        var minW = parseInt(containerStyles.getPropertyValue('width'));
        var minH = parseInt(containerStyles.getPropertyValue('height'));

        // If !border-box then add paddings to width and height
        if (containerStyles.getPropertyValue('box-sizing') !== 'border-box') {
            var paddingTop = containerStyles.getPropertyValue('padding-top');
            var paddingBottom = containerStyles.getPropertyValue('padding-bottom');
            var paddingLeft = containerStyles.getPropertyValue('padding-left');
            var paddingRight = containerStyles.getPropertyValue('padding-right');

            paddingTop = parseInt(paddingTop);
            paddingBottom = parseInt(paddingBottom);
            paddingLeft = parseInt(paddingLeft);
            paddingRight = parseInt(paddingRight);

            minW += paddingLeft + paddingRight;
            minH += paddingTop + paddingBottom;
        }

        // What's the min:intrinsic dimensions
        //
        // The idea is to get which of the container dimension
        // has a higher value when compared with the equivalents
        // of the video. Imagine a 1200x700 container and
        // 1000x500 video. Then in order to find the right balance
        // and do minimum scaling, we have to find the dimension
        // with higher ratio.
        //
        // Ex: 1200/1000 = 1.2 and 700/500 = 1.4 - So it is best to
        // scale 500 to 700 and then calculate what should be the
        // right width. If we scale 1000 to 1200 then the height
        // will become 600 proportionately.
        var widthRatio = minW / w;
        var heightRatio = minH / h;

        var new_width, new_height;

        // Whichever ratio is more, the scaling
        // has to be done over that dimension
        if (widthRatio > heightRatio) {
            new_width = minW;
            new_height = Math.ceil(new_width / videoRatio);
        } else {
            new_height = minH;
            new_width = Math.ceil(new_height * videoRatio);
        }

        this.videoEl.style.width = new_width + 'px';
        this.videoEl.style.height = new_height + 'px';
    }
});

/***/ }),

/***/ 39:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";


function delay(time) {
    return new Promise(function (fulfill) {
        setTimeout(fulfill, time);
    });
}

/* harmony default export */ __webpack_exports__["a"] = (delay);

/***/ })

});