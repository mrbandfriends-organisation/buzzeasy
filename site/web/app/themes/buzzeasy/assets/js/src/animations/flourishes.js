import TweenLite from 'gsap/TweenLite';
import TimeLineLite from 'gsap/TimeLineLite';
import DrawSVGPlugin from 'third-party/greensock/DrawSVGPlugin';

import inView from 'in-view';

'use strict';
/**
 * FLOURISHES
 *
 * Handles homepage flourish animations, when the section is in view.
 */

let flourishesTimeline = new TimeLineLite({paused:true});

flourishesTimeline.add( TweenLite.from( '#flourish-1 path', 1.25, {drawSVG:0, ease:Power1.easeIn } ) );
flourishesTimeline.add( TweenLite.from( '#flourish-2 path', 1.25, {drawSVG:0, ease:Power0.easeNone } ) );
flourishesTimeline.add( TweenLite.from( '#flourish-3 path', 1.25, {drawSVG:0, ease:Power1.easeOut } ) );

// Trigger the timeline when 60% of the Journey section is in the viewport.
inView.threshold(0.6);
inView('.customer-journey').on('enter', function(e){
    flourishesTimeline.play();
});