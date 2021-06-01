<?php
/**
 * Plugin Name: Woocommerce Product By Category
 * @author: Kesc23
 * Description: Tenha em seu site um ótimo componente responsivo para mostrar os produtos e suas categorias na sua loja
 * Author URI: https://felizex.press
 * @copyright: Copyright (c) 2021, Kesc23
 * @version: 0.7.0
 * @license: GPL v3.0 or Later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' )){
    exit;
}

/**
 * Declares the plugin version
 */
$wpc_version = '0.7.0';

/**
 * ACTION HOOK TO VERIFY IF WOOCOMMERCE IS ACTIVE
 * CASE FALSE, DISPLAY ERROR MESSAGE AND DEACTIVATE PLUGIN
 * 'wpc_show_messages' function args: ( string $wpc_message, string $wpc_message_type)
**/

if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) )
{
    do_action( 'admin_messages' , 'WooCommerce is not Activated. Please Activate Woocommerce', 'error');

    deactivate_plugins( 'woocommerce-product-by-category/woocommerce-product-by-category.php' );
}

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
