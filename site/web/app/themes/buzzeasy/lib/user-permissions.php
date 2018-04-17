<?php

namespace Roots\Sage\UserPermissions;

use Roots\Sage\Setup;


/**
 *  REMOVE CUSTOMIZER SETTINGS
 */
function custom_user_capabilities( $capabilities ) {

	$capabilities[] = 'hide_themes_menu';
	$capabilities[] = 'hide_customizer_menu';

	return $capabilities;
}
add_filter( 'members_get_capabilities', __NAMESPACE__.'\\custom_user_capabilities' );





/**
 *  REMOVE CUSTOMIZER SETTINGS
 */
 function removing_menu_items () {
    global $submenu;

    if ( function_exists( 'members_check_for_cap' ) && members_check_for_cap( 'hide_themes_menu' ) ) {
        unset($submenu['themes.php'][5]); // Appearance Menu -> Themes

    }

    if ( function_exists( 'members_check_for_cap' ) && members_check_for_cap( 'hide_customizer_menu' ) ) {
        unset($submenu['themes.php'][6]); // Appearance Menu -> Customize
    }
 }
 add_action('admin_menu',  __NAMESPACE__.'\\removing_menu_items');
