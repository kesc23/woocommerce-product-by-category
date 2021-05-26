<?php
/**
 * Plugin Name: Woocommerce Product By Category
 * Author: Kesc23
 * Description: Tenha em seu site um ótimo componente responsivo para mostrar os produtos e suas categorias na sua loja
 * Author URI: https://felizex.press
 * Copyright: (c) 2021 Kesc23
 * Version: 0.1.0
 * Licence: GPL v3.0 or Later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
**/

if ( ! defined( 'ABSPATH' )){
    exit;
}

//Define a constante do caminho para a pasta raiz do plugin caso não exista

if ( ! defined('__WPCDIR__'))
{
    define( '__WPCDIR__', (__DIR__) );
}

require_once (__WPCDIR__) . '/includes/wpc-functions.php';

require_once (__WPCDIR__) . '/includes/wpc-shortcodes.php';

//require_once plugin_dir_path (__FILE__) . 'includes/wcp-page.php';