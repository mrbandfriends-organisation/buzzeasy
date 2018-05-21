<?php
/*
Plugin Name:  Buzzeasy Functionality Plugin
Plugin URI:
Description:  Custom functionality Plugin for the Buzzeasy website. Deactivating this Plugin will break the website.
Version:      1.0.0
Author:       Mr B and Friends
Author URI:   http://www.mrbandfriends.co.uk
License:      Restricted
*/

namespace Buzzeasy;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Composer Autoloader
require_once __DIR__.'/vendor/autoload.php';

// Plugin Autoloader
require_once __DIR__.'/autoloader.php';

// Grab the core Plugin class
$core = Core::class;

// Register Plugin Activation / Deactivation
// register_activation_hook(__FILE__, [$core, 'activate']);
// register_deactivation_hook(__FILE__, [$core, 'deactivate']);

//  Rollbar
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;
if( env('WP_ENV') !== 'development' ) :
    Rollbar::init(
        array(
            'access_token' => 'a5ac436df1f7427f9bf17734dbc42883',
            'environment' => env('WP_ENV')
        )
    );
endif;

//  Initialise
add_action('plugins_loaded', [$core, 'initialise']);