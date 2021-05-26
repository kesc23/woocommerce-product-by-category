<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}

function wpc_category_write( $category )
{
    echo do_shortcode( '[products category'. $category .']' );
}

add_action( 'admin_menu', 'wpc_add_menu' );

function wpc_add_menu()
{
    add_menu_page(
        'Woocommerce Product By Category',
        'Product By Category',
        'manage_options',
        'includes/wpc-page.php',
        '',
        'dashicons-cart'
    );
}