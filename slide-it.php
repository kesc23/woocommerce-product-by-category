<?php
/**
 * Plugin Name: Slide it! Slider For WooCommerce
 * @author: Kesc23
 * Description: Put an useful, beautiful & responsive slider to show products inside your store.
 * Author URI: https://felizex.press
 * @copyright: Copyright (c) 2021, Kesc23
 * @version: 2.0.0
 * @license: GPL v3.0 or Later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' )){
    exit;
}

/**
 * Declares the plugin version
 */
$wpc_version = '2.0.0';


/**
 * Defines the plugin root path
 * 
 * @since 0.7.0
 */

if ( ! defined('WPCDIR'))
{
    define( 'WPCDIR', (__DIR__) );
}

/**
 * Defines Admin path to the plugin
 * 
 * @since 0.7.0
 */
if ( ! defined('WPCADMIN') )
{
    define( 'WPCADMIN', WPCDIR . '/admin' . '/');
}

/**
 * Defines includes path to the plugin
 * 
 * @since 0.7.0
 */
if ( ! defined( 'WPCINC' ))
{
    define( 'WPCINC', WPCDIR . '/includes' . '/' );
}

define( 'WPCDEV', true );

/**
 * Defines for the development process to begin
 */
if ( defined( 'WPCDEV' ) && @WPCDEV == true ){
    include_once 'includes/glass/config.php';
    glassInit();
}

/**
 * Loads the main scripts to run the plugin
 */

require_once WPCINC . 'wpc-functions.php';

require_once WPCINC . 'wpc-shortcodes.php';

require_once WPCADMIN . 'admin-functions.php';

require_once 'slide-it-deactivation.php';

/**
 * @since 0.7.1 Action hooks added to correct some mess from 0.7.0
 * 
 * @since 0.7.2 hook wpc_activated to correct another mess
 * @since 1.0.0 added a cleaner way to load styles in WPC admin page.
 * @since 1.0.1 hook wpc_activated was excluded temporarily due to bugs in wp while loading: UNDER INVESTIGATION
 */
add_action( 'wp_loaded', 'wpc_scripts_register');

add_action( 'wp_enqueue_scripts', 'wpc_scripts');

// add_action( 'activated_plugin', 'wpc_activated');

add_action( 'wp_loaded', 'wpc_activated');

add_action( 'admin_enqueue_scripts', 'wpc_admin_style');

//Added to dequeue and deregister scripts when deactivating.
register_deactivation_hook( __FILE__, 'wpcOnDeactivate' );
