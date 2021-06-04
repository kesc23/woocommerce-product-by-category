<?php
/**
 * Plugin Name: Woocommerce Product By Category
 * @author: Kesc23
 * Description: Tenha em seu site um ótimo componente responsivo para mostrar os produtos e suas categorias na sua loja
 * Author URI: https://felizex.press
 * @copyright: Copyright (c) 2021, Kesc23
 * @version: 0.8.0
 * @license: GPL v3.0 or Later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' )){
    exit;
}

/**
 * Declares the plugin version
 */
$wpc_version = '0.8.0';


/**
 * Defines the plugin root path
 * 
 * @since 0.7.0
 */

if ( ! defined('__WPCDIR__'))
{
    define( '__WPCDIR__', (__DIR__) );
}

/**
 * Defines Admin path to the plugin
 * 
 * @since 0.7.0
 */
if ( ! defined('WPCADMIN') )
{
    define( 'WPCADMIN', __WPCDIR__ . '/admin' . '/');
}

/**
 * Defines includes path to the plugin
 * 
 * @since 0.7.0
 */
if ( ! defined( 'WPCINC' ))
{
    define( 'WPCINC', __WPCDIR__ . '/includes' . '/' );
}

/**
 * Loads the main scripts to run the plugin
 */

require_once WPCINC . 'wpc-functions.php';

require_once WPCINC . 'wpc-shortcodes.php';

require_once WPCADMIN . 'admin-functions.php';

/**
 * @since 0.7.1 Action hooks added to correct some mess in 0.7.0
 * 
 * @since 0.7.2 hook wpc_activated to correct another mess
 */
add_action( 'wp_loaded', 'wpc_scripts_register');

add_action( 'wp_enqueue_scripts', 'wpc_scripts');

add_action( 'activated_plugin', 'wpc_activated');

add_action( 'wp_loaded', 'wpc_activated');