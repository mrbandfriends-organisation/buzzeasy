import TweenLite from 'gsap/TweenLite';
import TimeLineLite from 'gsap/TimeLineLite';
import DrawSVGPlugin from 'third-party/greensock/DrawSVGPlugin';

import inView from 'in-view';

'use strict';
/**
 * FLOURISHES GREENSOCK
 *
 * Handles flourish animations when the section is in view
 */

let flourishesTimeline = new TimeLineLite({paused:true});

flourishesTimeline.add( TweenLite.from( '#flourish-1 path', 1.25, {drawSVG:0, ease:Power1.easeIn } ) ); // 154
flourishesTimeline.add( TweenLite.from( '#flourish-2 path', 1.25, {drawSVG:0, ease:Power0.easeNone } ) ); // 271
flourishesTimeline.add( TweenLite.from( '#flourish-3 path', 1.25, {drawSVG:0, ease:Power1.easeOut } ) ); // 160

inView.threshold(0.6);

inView('.customer-journey').on('enter', function(e){
    flourishesTimeline.play();
});