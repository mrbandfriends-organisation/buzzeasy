<?php

namespace Roots\Sage\SEO;

use Roots\Sage\Setup;


/**
 * PREVENT ROBOTS CRAWLING STAGING
 *
 * if env is not production add a blocking
 * meta tag to discourage robots getting involved
 */
function add_no_robots_meta() {
    if ( WP_ENV !== 'production' ) {
      $meta_tag='<meta name="robots" content="noindex">';
      echo $meta_tag;
    }
}
add_action('wp_head', __NAMESPACE__ . '\\add_no_robots_meta');





/**
 * MOVE YOAST TO BOTTOM OF EDIT SCREENS
 *
 * Ensure Yoast SEO options appear underneath other meta boxes
 */
function move_yoast_to_botttom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'move_yoast_to_botttom');





/**
 * ADD SITEMAP REF TO ROBOTS.TXT
 * add a sitemap reference to the robots file
 */
add_filter('robots_txt', function($content, $is_public) {
    $content .= "\n";
    $content .= "Sitemap: " . home_url('sitemap_index.xml');
    $content .= "\n";
    return $content;
}, 10, 2);





/**
 *  DISABLE ATTACHMENT URL
 *
 *  If go to an attachment page then re-dirceted to the post parent or homepage
 */
function disable_attachment_page() {
    // 1. Checking if its an attachment page
    if( is_attachment() ) {

        // 2. Getting id of current posts and its parent
        $post_id        = ( !empty($post->id) ) ? $post->id : null;
        $post_parent_id = ( !empty(wp_get_post_parent_id( $post_id )) ) ? wp_get_post_parent_id( $post_id ) : null;

        // 3. Getting URL for re-direction
        if( !empty($post_parent_id) ) {
            $redirect_url = get_permalink($post_parent_id);
        } else {
            $redirect_url = home_url();
        }

        // 4. Redirecting to the new page
        wp_redirect( $redirect_url );
        exit();
    }
}
add_action( 'template_redirect', __NAMESPACE__ . '\\disable_attachment_page' );
