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
        $wpc_message_class = '"error notice is-dismissible"';
        $wpc_error = "<strong>ERROR</strong>: ";
    } else {
        $wpc_message_class = '"updated notice is-dismissible"';
    }
    
    echo ('<div class=' . $wpc_message_class . '><p>' . $wpc_error . $wpc_message . '</p></div>');
}
//Action hook inside wordpress
add_action( 'admin_messages', 'wpc_show_messages', 10, 2);


/**
 * Function to display the shortcode in the admin page.
 *
 * @since 0.7.0
 * @since 2.0.0 now validates existing, non-empty categories.
 * 
 * @return string returns the shotcode field
 */
function wpc_display_shortcode()
{
    if ( isset($_POST['cat-name']) && isset($_POST['num-p'])):

        //Obtaining the name of valid, non-empty categories.
        $cat_list = get_categories(
            array(
                'taxonomy'=> 'product_cat'
            )
        );
        foreach( $cat_list as $validCategory ):
            $notEmptyCategories[] = $validCategory->name;
        endforeach;

        if ( $_POST['cat-name'] == '' || $_POST['cat-name'] == null ):
            return do_action( 'admin_messages' , 'Category not inserted', 'error'); // returns error if category name is not set
        elseif ( ! in_array( $_POST['cat-name'], $notEmptyCategories ) ):
            return do_action( 'admin_messages' , 'Category entered is empty or invalid', 'error');
        elseif ( $_POST['num-p'] <= -2 ):
            return do_action( 'admin_messages' , 'Invalid Number' , 'error'); // returns error if num-p is less than 2. -1 has a role.
        else:
        
            return do_action( 'admin_messages' , 'This is yours shortcode. Put it in the desired page', 'updated') .
            '
            <div class="wpc-shortcode-field">
                <p id="wpc-short-text">[WPC_SHOW_CONTAINER cat-name="' . $_POST['cat-name'] . '" num-p="' . $_POST["num-p"] . '" p-order="' . $_POST["p-order"] .'"]</p>
                <span class="wpc-copy" data-clipboard-action="copy" data-clipboard-target="#wpc-short-text" style="cursor: pointer;">
                    <i class="far fa-clipboard"></i>
                </span>
            </div>
            ';
        
        endif;
    endif;
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

    //prePrint_r( $wpc_cat_list );

    /**
     * We can access the object from WP_Term Class inside an array.
     * print_r($wpc_cat_list[1])
     * 
     * if using Glass, you can now prePrint_r( $wpc_cat_list ) gathering
     * the entire info from the variable, or addressing a key to it.
     */
    foreach ( $wpc_cat_list as $listItem ) :
	    if ( empty( $listItem ) ) :
		    continue;
	    else:
		    $wpc_catname_datalist .= '<option value="' . $listItem->name . '">';
	    endif;
    endforeach;
    return $wpc_catname_datalist;
}

/**
 * Function to add Stylesheet for the WPC admin page.
 * 
 * @since 0.7.0
 * 
 * @since 1.0.0           Updated format to better fit 
 *                        WordPress enqueueing in admin pages
 *                        and changed to admin-functions.php
 */
function wpc_admin_style()
{
    // if page is set and is WPC admin page
    if ( isset($_GET['page']) && $_GET['page'] == 'slide-it' )
    {
        wp_enqueue_style( 'wpc_admin', plugins_url( 'style.css' , __DIR__ . '/admin' ) );
        wp_enqueue_style( 'wpc_FA_font_style' );
    }
}