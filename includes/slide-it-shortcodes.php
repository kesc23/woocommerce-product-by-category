<?php

if( ! defined( 'ABSPATH' ) ): exit; endif;

require_once slideIT_INC . 'slide-it-functions.php';

/**
 * @deprecated @since 0.5.0
 */
add_shortcode('WPC-Show-By-Category', 'wpc_shortcode_to_products');

/**
 * This Hook allows WordPress to create a shortcode to display WPC scroller
 * @deprecated @since 2.2.0
 * But it is still usable, but note recommended as we'll add a better way to create the shortcodes.
 */
add_shortcode('WPC_SHOW_CONTAINER', 'slideIT_shortcode_container');

/**
 * @since 2.2.0 official shortcode for Slide it!
 */
add_shortcode( 'SLIDEIT_SHOW_CONTAINER', 'slideITShortcodeContainer' );

