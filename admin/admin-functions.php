<?php
/**
 * Creates the functionalities to be called in admin page section.
 * 
 * @author Kesc23
 * @version 0.7.0
 */



if ( ! defined( 'ABSPATH' ) || ! defined( 'WPCADMIN' ) ){
    exit;
}


/**
 * Create a way to display a formated message inside wordpress.
 * 
 * @param string $wpc_message       Message from the program to tell if
 *                                  something is wrong or updated.
 * 
 * @param string $wpc_message_type  Specifies the class for the message.
 *                                  Then the program uses it to call the
 *                                  native WordPress Bootstrap and applies
 *                                  the class.
 * @since 0.6.0
 */
function wpc_show_messages( string $wpc_message, string $wpc_message_type)
{
    //error & class message variables
    $wpc_error = null;
    $wpc_message_class = null;

    if ($wpc_message_type == "error")
    {
        $wpc_message_class = '"error"';
        $wpc_error = "<strong>ERROR</strong>: ";
    } else {
        $wpc_message_class = '"updated"';
    }
    
    echo ('<div class=' . $wpc_message_class . '><p>' . $wpc_error . $wpc_message . '</p></div>');
}
//Action hook inside wordpress
add_action( 'admin_messages', 'wpc_show_messages', 10, 2);


/**
 * Function to display the shortcode in the admin page.
 *
 * @return string returns the shotcode field
 * 
 * @since 0.7.0
 */
function wpc_display_shortcode()
{
    if ( isset($_POST['cat-name']) && isset($_POST['num-p']) && isset($_POST['p-order']))
    {
        if ( $_POST['cat-name'] == '' || $_POST['cat-name'] == null ) {
            return do_action( 'admin_messages' , 'Categoria não inserida', 'error');
        } else {
            return do_action( 'admin_messages' , 'Esse é o seu shortcode. insira-o na página desejada', 'updated') . '
            <div class="wpc-shortcode-field">
                <p>[WPC_PRODUCT_SHORTCODE cat-name="' . $_POST['cat-name'] . '" num-p=' . $_POST["num-p"] . '" p-order="' . $_POST["p-order"] .'"]</p>
                <p></p>
            </div>
            ';
        }
    }
}