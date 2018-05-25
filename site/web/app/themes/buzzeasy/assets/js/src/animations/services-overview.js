import TimelineLite from 'gsap/TimelineLite';
import CSSPlugin from 'gsap/CSSPlugin';

import inView from 'in-view';

'use strict';
/**
 * SERVICES OVERVIEW
 *
 * Handles service overview animations, when the section is in view.
 */

let servicesTimeline = new TimelineLite({paused:true});

servicesTimeline.staggerFrom( '.service-overview__logo', 0.5, { opacity:0, top:15, ease:Power1.easeIn }, 0.25 );

// Trigger the timeline when 30% of the Services Overview section is in the viewport.
inView.threshold(0.3);
inView('.services-overview').on('enter', function(e){
    servicesTimeline.play();
});