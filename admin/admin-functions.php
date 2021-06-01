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
 * @since 0.7.0
 * 
 * @return string returns the shotcode field
 */
function wpc_display_shortcode()
{
    if ( isset($_POST['cat-name']) && isset($_POST['num-p']))
    {
        if ( $_POST['cat-name'] == '' || $_POST['cat-name'] == null )
        {
            // returns error if category name is not set
            return do_action( 'admin_messages' , 'Categoria não inserida', 'error');
        
        } elseif ( $_POST['num-p'] <= -2 )
        {
            // returns error if num-p is less than 2. -1 has a role.
            return do_action( 'admin_messages' , 'Número Inválido' , 'error');
        
        } else {
        
            return do_action( 'admin_messages' , 'Esse é o seu shortcode. insira-o na página desejada', 'updated') .
            '
            <div class="wpc-shortcode-field">
                <p id="wpc-short-text">[WPC_PRODUCT_SHORTCODE cat-name="' . $_POST['cat-name'] . '" num-p=' . $_POST["num-p"] . '" p-order="' . $_POST["p-order"] .'"]</p>
                <span class="wpc-copy" data-clipboard-action="copy" data-clipboard-target="#wpc-short-text" style="cursor: pointer;">
                    <i class="far fa-clipboard"></i>
                </span>
            </div>
            ';
        
        }
    }
}

/**
 * Show Category list function.
 *
 * @since 0.7.0
 * 
 * @return string       Queries inside the WP DB and retrieve the
 *                      product categories inside an array.
 *                      Then returns it inside a option HTML tag
 *                      to be put inside a datalist.
 */
function wpc_show_categories()
{
    /**
     * This routine is to access the Product Categories
     * from WooCommerce inside the Database.
     */
    $wpc_cat_list = get_categories(
        array(
            'taxonomy'=> 'product_cat'
        )
    );

    /**
     * We can access the object from WP_Term Class inside an array.
     * print_r($wpc_cat_list[1])
     */

    $wpc_catname_datalist = ''; //The variable for the datalist.

    for($i=1; @is_object($wpc_cat_list[$i]); $i++)
    {   
        if ( empty($wpc_cat_list[$i]))
        {
            return;
        } else {
            $wpc_catname_datalist .= '<option value="' . $wpc_cat_list[$i]->to_array()['name'] . '">';
        }
    }
    return $wpc_catname_datalist;
}