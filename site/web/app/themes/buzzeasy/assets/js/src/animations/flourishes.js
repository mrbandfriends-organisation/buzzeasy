import TweenLite from 'gsap/TweenLite';
import TimeLineLite from 'gsap/TimeLineLite';
import DrawSVGPlugin from 'third-party/greensock/DrawSVGPlugin';

'use strict';
/**
 * FLOURISHES GREENSOCK
 *
 * The flourish animations
 */

let flourishesTimeline = new TimeLineLite;

flourishesTimeline.add( TweenLite.from( '#flourish-1 path', 1.5, {drawSVG:0} ) );
flourishesTimeline.add( TweenLite.from( '#flourish-2 path', 1.5, {drawSVG:0} ) );
flourishesTimeline.add( TweenLite.from( '#flourish-3 path', 1.5, {drawSVG:0} ) );

flourishesTimeline.play();