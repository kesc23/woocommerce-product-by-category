<?php

if ( ! defined( 'ABSPATH' ) && ! defined( 'WPCINC' ) ){
    exit;
}

/**
 * ADICIONA MENU DO PLUGIN
**/

add_action( 'admin_menu', 'wpc_add_menu' );


/**
 * Function to define the plugin admin page
 * 
 * 
 * 
 * @since 0.1.0
 */
function wpc_add_menu()
{   
    
    add_menu_page(
        'Woocommerce Product By Category',
        'Product By Category',
        'manage_options',
        "/wpc-page",
        'wpc_admin_page',
        'dashicons-cart',
        58
    );
    
}


/**
 * FUNÇÃO PARA EXIBIR O ADMIN 
**/

function wpc_admin_page(){
    include_once WPCADMIN . 'adminpage.php';
}

/**
 * This function helps to register the styles for the boxes.
 * 
 * @since 0.7.1
 */
function wpc_scripts_register()
{
    wp_register_style( 'wpc_loop', plugin_dir_url( dirname(__FILE__)) . 'includes/styles/wpc_loop.css', '', null);

    wp_register_style( 'wpc_FA_font_style', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');

    //Register Kit Fontawesome Script
    wp_register_script( 'wpc_kit_fontawesome', 'https://kit.fontawesome.com/b3fc9df41f.js');

}

/**
 * This function help to load the styles for the boxes.
 * 
 * @since 0.7.1
 */
function wpc_scripts(){

    //Calls The Script for the icons
    wp_enqueue_script( 'wpc_kit_fontawesome' );

    //Calls The Stylesheet for the loop
    wp_enqueue_style( 'wpc_loop', '', null);

    //Calls The style for the icons
    wp_enqueue_style( 'wpc_FA_font_style' );
}



/**
 * The function below is the base to add woocommerce shortcode.
 * This is the Earliest, conceptual and old day to display the scroller.
 * It won't work properly and is deprecated.
 * 
 * @return string       returns a string with all HTML tags needed
 *                      surrounding the [product] woocommerce
 *                      shortcode.
 * 
 * @since 0.2.0 
 * @since 0.7.0         @deprecated 
**/
function wpc_shortcode_to_products()
{


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

/**
 * CUSTOM TEMPLATE FOR PRODUCT LOOP
 * 
 * NOT WOOCOMMERCE BASED
 * WILL WORK IF custom POST TYPE 'PRODUCT' IS DEFINED
 * 
 * @since 0.6.0
 */
require_once ((WPCDIR) . '/includes/product-loop.php');


/**
 * This Function is Used to display the products inside a scroller.
 * 
 * @return string 
 * 
 * @since 0.6.0
 * @since 0.7.0 added the functionality to filter by its attributes
 * passed in the shorcode.
 */
function wpc_shortcode_container( $atts )
{
    $atts = shortcode_atts(
        array(
            'cat-name'      => '',
            'num-p'         => 5,
            'p-order'       => 'ASC'
        ), $atts );   

    /**
     * @see 'wpc_get_template()' in 'includes/product-loop.php'
     * 
     * @since 0.6.0
     */
    
    return wpc_get_template($atts['cat-name'], $atts['num-p'], $atts['p-order']);

}

/**
 * function to define ACTION HOOK TO VERIFY IF WOOCOMMERCE IS ACTIVE
 * CASE FALSE, DISPLAY ERROR MESSAGE AND DEACTIVATE PLUGIN
 * 'wpc_show_messages' function args: ( string $wpc_message, string $wpc_message_type)
 * 
 * @since 0.7.2
**/
function wpc_activated(){

    if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) )
    {
        do_action( 'admin_messages' , 'WooCommerce is not Activated. Please Activate Woocommerce', 'error');

        deactivate_plugins( WPCDIR . '/woocommerce-product-by-category.php' );
    }

}