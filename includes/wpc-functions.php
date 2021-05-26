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




/**
 * A FUNÇÃO A SEGUIR É A BASE PARA ADICIONAR OS SHORTCODES DO WOOCOMMERCE
**/

function wpc_shortcode_to_products()
{
    
    return
    '<header>
        <style>
            .wpc-scroller {
                width: 100%;
                overflow-x: scroll;
                display: block
            }
            @media only screen and (min-width: 768px){
                .wpc.wrap {
                    display: inline-flex;
                    align-items: center;
                    flex-wrap: wrap;
                }
                .wpc-scroller {
                    width: 90%;
                    overflow-x:
                    unset;
                    display: inline-block;
                }
                .woocommerce .products ul, .woocommerce ul.products {
                    width: 90%!important;
                }
                span.wpc-btn {
                    display: inline;
                    margin: 5px auto;
                }
            }
            .woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
                margin: 0px 4px!important;
            }
            .woocommerce ul.products, .woocommerce-page ul.products {
                flex-wrap: nowrap;
                flex-direction: row;
            }
            .woocommerce .products ul, .woocommerce ul.products {
                width: 125%;
                min-width: 450px;
            }
            .woocommerce .button {
                display: none!important;
            }
            span.wpc-btn {
                padding: 12px;
                background-color: white;
                border-radius: 100%;
                height: 45px;
                width: 45px;
                display: block;
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .wpc{
                border-width: 1px;
                border-style: solid;
                border-color: red;
            }
            .wpc-cat{
                width: 100%;
            }
        </style>
    </header>'
    . '<div class="wpc wrap">
        <div class="wpc-cat">Category Name</div>
        <span class="wpc-scroller">'
            . do_shortcode( '[products limit="10" columns="5"]' ) .
        '</span>
        <span class="wpc-btn">
            <a href="">
            <span class="dashicons dashicons-arrow-right-alt"></span>
            </a>
        </span>
    </div>';
}