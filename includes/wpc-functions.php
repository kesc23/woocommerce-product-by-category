<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}

/**
 * FUNÇÃO PARA EXIBIR O ADMIN 
**/

function wpc_admin_page(){
    include_once (__WPCDIR__) . '/admin/adminpage.php';
}

/**
 * ADICIONA MENU DO PLUGIN
**/

add_action( 'admin_menu', 'wpc_add_menu' );

function wpc_add_menu()
{
    add_menu_page(
        'Woocommerce Product By Category',
        'Product By Category',
        'manage_options',
        "/wpc-page.php",
        'wpc_admin_page',
        'dashicons-cart',
        58
    );
}

//Register Stylesheets for plugin

wp_register_style( 'wpc_loop', plugin_dir_url( dirname(__FILE__)) . 'includes/styles/wpc_loop.css', '', 'v0.4.0');

wp_register_style( 'wpc_loop_elementor', plugin_dir_url( dirname(__FILE__)) . 'includes/styles/wpc_loop_elementor.css');

wp_register_style( 'wpc_FA_font_style', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');


//Register Kit Fontawesome Script

wp_register_script( 'wpc_kit_fontawesome', 'https://kit.fontawesome.com/b3fc9df41f.js');

/**
 * A FUNÇÃO A SEGUIR É A BASE PARA ADICIONAR OS SHORTCODES DO WOOCOMMERCE
**/

function wpc_shortcode_to_products()
{
    //Calls The Script for the icons
    wp_enqueue_scripts( 'wpc_kit_fontawesome' );

    //Calls The Stylesheet for the loop
    wp_enqueue_style( 'wpc_loop', '', 'v0.4.0');

    //Calls The Script for the icons
    wp_enqueue_style( 'wpc_FA_font_style' );

    //IF ELEMENTOR IS ACTIVE
    if (is_plugin_active( 'Elementor/elementor.php' ))
    {
        //Calls The Stylesheet for the loop if Elementor is active
        wp_enqueue_style( 'wpc_loop_elementor' );
    }

    return 
    '<div class="wpc wrap">
        <div class="wpc-cat">
            <h3 style="font-size: 21px; margin: 5px;">Category Name</h3>
        </div>
        <span class="wpc-scroller">
            <span class="wpc-post-content">'
            .    do_shortcode( '[products limit="10" columns="5"]' ) .
            '</span>
            <span class="wpc-btn">
                <a href="">'
                .   '<i class="fas fa-arrow-right" style="font-size: 20px;"></i>
                Veja Mais
                </a>
            </span>
        </span>
    </div>';
}


function wpc_shortcode_container()
{
    //Calls The Script for the icons
    wp_enqueue_scripts( 'wpc_kit_fontawesome' );

    //Calls The Stylesheet for the loop
    wp_enqueue_style( 'wpc_loop', '', 'v0.4.0');

    //Calls The Script for the icons
    wp_enqueue_style( 'wpc_FA_font_style' );

    //IF ELEMENTOR IS ACTIVE
    if (is_plugin_active( 'Elementor/elementor.php' ))
    {
        //Calls The Stylesheet for the loop if Elementor is active
        wp_enqueue_style( 'wpc_loop_elementor' );
    }

    return 
    '<div class="wpc wrap">
        <div class="wpc-cat">
            <h3 style="font-size: 21px; margin: 5px;">Category Name</h3>
        </div>
        <span class="wpc-scroller">
            <span class="wpc-post-content">
                DO SOMETHING
            </span>
            <span class="wpc-btn">
                <a href="">
                    <i class="fas fa-arrow-right" style="font-size: 20px;"></i>
                Veja Mais
                </a>
            </span>
        </span>
    </div>';
}