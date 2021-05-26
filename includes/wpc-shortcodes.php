<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}

require_once (__WPCDIR__) . '/includes/wpc-functions.php';

add_shortcode('WPC-Show-By-Category', 'wpc_shortcode_to_products');