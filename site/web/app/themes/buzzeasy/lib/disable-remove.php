<?php

namespace Roots\Sage\DisableRemove;

use Roots\Sage\Setup;

/**
 * Remove WP 4.2 Emoyicons
 *
 * WP 4.2 introduced emojis (smileys) that basically
 * adds JS and other junk all over your pages.
 *
 */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

}
add_action( 'init', __NAMESPACE__ . '\\disable_wp_emojicons' );


/**
 * Generic Function for Dequeing scripts and styles
 * added by naughty Plugins!
 */
function dequeue_scripts() {
    wp_dequeue_script('picturefill');
    if (WP_ENV === 'production') {
      wp_deregister_script( 'jquery' );
    //   wp_deregister_script( 'wp-embed' ); // If you dont need to be able to emebed content dereigster this script
    }

}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\dequeue_scripts', 10);
