<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}

/**
 * FUNÇÃO PARA EXIBIR O ADMIN 
 * A função abaixo exibe o conteúdo do plugin no admin 
**/

function wpc_admin_page(){
    include_once (__WPCDIR__) . '/admin/adminpage.php';
}


add_action( 'admin_menu', 'wpc_add_menu' );

function wpc_add_menu()
{
    add_menu_page(
        'Woocommerce Product By Category',
        'Product By Category',
        'manage_options',
        "/wpc-page.php",
        'wpc_admin_page',
        'dashicons-cart'
    );
}