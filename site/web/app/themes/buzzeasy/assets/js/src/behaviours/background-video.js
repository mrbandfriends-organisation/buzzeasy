'use strict';
/**
 * BACKGROUND VIDEO
 *
 */

import BackgroundVideo from 'lib/background-video';

const backgroundVideos = Array.from(
    document.querySelectorAll('.js-background-video')
);

if (backgroundVideos.length) {
    backgroundVideos.forEach(video => {
        new BackgroundVideo(video);
    });
}
