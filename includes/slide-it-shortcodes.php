<?php

if( ! defined( 'ABSPATH' ) ): exit; endif;

require_once slideIT_INC . 'slide-it-functions.php';

add_shortcode('WPC-Show-By-Category', 'wpc_shortcode_to_products');


// This Hook allows WordPress to create a shortcode to display WPC scroller

add_shortcode('WPC_SHOW_CONTAINER', 'slideIT_shortcode_container');
