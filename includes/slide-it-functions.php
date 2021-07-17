<?php

if ( ! defined( 'ABSPATH' ) && ! defined( 'slideIT_INC' ) ): exit; endif;

/**
 * Function to define the plugin admin page
 * 
 * @since 0.1.0
 * @since 2.0.0 changed several things for rebranding.
 * @since 2.1.0 changed name from wpc_add_menu to slideIT_add_menu
 */
function slideIT_add_menu()
{   
    
    add_menu_page(
        'Slide It!',
        'Slide It!',
        'manage_options',
        "/slide-it",
        'slideIT_admin_page',
        'dashicons-slides',
        58
    );
}

/**
 * This function includes the admin page.
 * @since 2.1.0 changed name from wpc_admin_page to slideIT_admin_page
 */
function slideIT_admin_page()
{
    include_once slideIT_ADMIN . 'adminpage.php';
}

/**
 * This function helps to register the styles for the boxes.
 * 
 * @since 0.7.1
 * @since 2.1.0 changed name from wpc_scripts_register to slideIT_scripts_register
 */
function slideIT_scripts_register()
{
wp_register_style( 'slideIT_loop', plugin_dir_url( __DIR__ ) . 'includes/styles/slide-it-loop.css', '', '6.3' );

    wp_register_style( 'fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css' );

    //Register Kit Fontawesome Script
    wp_register_script( 'fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/js/all.js' );

    //Calls WP included Clipboard JS
    wp_register_script( 'slideIT_ClipboardJS', includes_url( '/js/clipboard.min.js' ) );

    wp_register_script( 'slideIT_loop_script', plugin_dir_url( __DIR__ ) . 'includes/scripts/slide-it-loop-script.js', '', null, true );
}

/**
 * This function help to load the styles for the boxes.
 * 
 * @since 0.7.1
 * @since 2.1.0 changed name from wpc_scripts to slideIT_scripts
 */
function slideIT_scripts(){

    //Calls The Script for the icons
    wp_enqueue_script( 'fontawesome' );

    //Calls The Stylesheet for the loop
    wp_enqueue_style( 'slideIT_loop' );

    //Calls The style for the icons
    wp_enqueue_style( 'fontawesome' );

    //Calls the script for loop dynamics
    wp_enqueue_script( 'slideIT_loop_script' );
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
require_once slideIT_INC . 'product-loop.php';


/**
 * This Function is Used to display the products inside a scroller.
 * 
 * @return string 
 * 
 * @since 0.6.0
 * @since 0.7.0 added the functionality to filter by its attributes passed in the shorcode.
 * @since 2.1.0 changed name from wpc_shortcode_containter to slideIT_shortcode_containter
 */
function slideIT_shortcode_container( $atts )
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
    return slideIT_get_template($atts['cat-name'], $atts['num-p'], $atts['p-order']);
}

/**
 * This function adds the new shortcodes to the project.
 * Now we can add the new card style for the project.
 * 
 * @since 2.2.0
 *
 * @param  array $atts the attributes passed by the shortcode
 * @return void
 */
function slideITShortcodeContainer( $atts )
{
    $atts = shortcode_atts(
        array(
            'cat-name' => '',
            'num-p'    => 5,
            'p-order'  => 'ASC',
            'cards'    => 'default',
        ),
        $atts
    );
    
    return slideITGetTemplate( $atts['cat-name'], $atts['num-p'], $atts['p-order'], $atts['cards'] );
}

/**
 * function to define ACTION HOOK TO VERIFY IF WOOCOMMERCE IS ACTIVE
 * CASE FALSE, DISPLAY ERROR MESSAGE AND DEACTIVATE PLUGIN
 * 'wpc_show_messages' function args: ( string $wpc_message, string $wpc_message_type)
 * 
 * @since 0.7.2
 * @since 2.1.0          The action hook to add the menu is only added if the plugin is correctly loaded.
 *                       This is to prevent the Slide It menu being visible after the plugin is deactivated
 *                       in case some error / missing, deactivated woocommerce event.
 *                       Changed function name from wpc_activated to slideIT_activated
 * @since 2.1.3          Changed because it was causing a fatal error.
 * @return boolean
 */
function slideIT_activated()
{
    if ( ! in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins', array() ) ) ):
             
        echo slideIT_show_messages( 'WooCommerce is not Activated. Please Activate Woocommerce', 'error' );
    
        //deactivate_plugins( slideIT_DIR . 'slide-it.php' );
        return false;
    endif;

    // ADICIONA MENU DO PLUGIN
    add_action( 'admin_menu', 'slideIT_add_menu' );
    return true;
}