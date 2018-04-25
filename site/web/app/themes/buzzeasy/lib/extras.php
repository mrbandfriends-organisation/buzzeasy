<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

use Roots\Sage\Utils;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



/**
 * PHP JS VARIABLES
 *
 * makes PHP vars available in JavaScript
 */
function php_js_vars() {
?>
    <script>
    var LOCALISED_VARS = LOCALISED_VARS || {};

    <?php
        $feature_flags = ( defined('FEATURE_FLAGS') ) ? 'FEATURE_FLAGS' : [];
    ?>
    LOCALISED_VARS.env                                = <?php echo json_encode( WP_ENV ) ?>;
    LOCALISED_VARS.ajaxurl                           = <?php echo json_encode( admin_url( "admin-ajax.php" ) ) ?>;
    LOCALISED_VARS.ajaxnonce                         = <?php echo json_encode( wp_create_nonce( "lv_ajax_nonce" ) ) ?>;
    LOCALISED_VARS.stylesheet_directory_uri          = <?php echo json_encode( get_stylesheet_directory_uri() ) ?>;
    LOCALISED_VARS.feature_flags                     = <?php echo json_encode( Utils\get_active_features() ) ?>;
    </script>
<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\\php_js_vars' );



/**
 * ALLOW SVG UPLOADS TO MEDIA LIBRARY
 *
 */
function upload_svg_media_library($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_action('upload_mimes', __NAMESPACE__ . '\\upload_svg_media_library');



/**
* OPEN LINK IN NEW TAB
*
* Safely opens link in a new tab
*
*/
function link_open_new_tab_attrs($return = false)
{
$string = 'target="_blank" rel="noopener" rel="noreferrer"';

if ($return) {
    return $string;
} else {
    echo $string;
}
}


/*
 *  Add Site by Mr B to end of footer menu
 *
 */
add_filter('wp_nav_menu_items', __NAMESPACE__.'\\site_by_mrb', 10, 2);
function site_by_mrb($nav, $args)
{
    // Currently footer utils menu doesnt have a string name just it's ID
    if ($args->menu === "footer_navigation") {
       // return $nav . '<li class="menu-item"><a ' . link_open_new_tab_attrs(true) . ' href="https://www.mrbandfriends.co.uk">Site by Mr B & Friends</a></li>';
    }

    return $nav;
}
