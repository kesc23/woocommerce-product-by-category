<?php
/**
 * Creates the functionalities to be called in admin page section.
 * 
 * @author Kesc23
 * @version 0.7.0
 */



if ( ! defined( 'ABSPATH' ) || ! defined( 'slideIT_ADMIN' ) ){
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
 * @since 2.1.0                     changed name from wpc_show_messages to slideIT_show_messages
 */
function slideIT_show_messages( string $wpc_message, string $wpc_message_type)
{
    //error & class message variables
    $wpc_error = null;
    $wpc_message_class = null;

    $wpc_message = esc_attr( $wpc_message ); //escaping the message for WP.

    if ($wpc_message_type == "error"):
        $wpc_message_class = '"error notice is-dismissible"';
        $wpc_error         = "ERROR: ";
    else:
        $wpc_message_class = '"updated notice is-dismissible"';
    endif;
    //$wpc_message_class && $wpc_error are only used internally by the function.
    return "<div class={$wpc_message_class}><p><strong>{$wpc_error}</strong>{$wpc_message}</p></div>";
}
//Action hook inside wordpress
//add_action( 'admin_messages', 'slideIT_show_messages', 10, 2);


/**
 * Function to display the shortcode in the admin page.
 *
 * @since 0.7.0
 * @since 2.0.0 now validates existing, non-empty categories.
 * @since 2.1.0 Changed name from wpc_display_shortcode to slideIT_display_shortcode.
 *              Attributes passed by $_POST are now escaped for WP.
 * 
 * @return string returns the shotcode field
 */
function slideIT_display_shortcode()
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
            echo slideIT_show_messages( 'Category not inserted', 'error' ); // returns error if category name is not set
        elseif ( ! in_array( $_POST['cat-name'], $notEmptyCategories ) ):
            echo slideIT_show_messages( 'Category entered is empty or invalid', 'error');
        elseif ( $_POST['num-p'] <= -2 ):
            echo slideIT_show_messages( 'Invalid Number' , 'error'); // returns error if num-p is less than 2. -1 has a role.
        else:
            echo slideIT_show_messages( 'This is yours shortcode. Put it in the desired page', 'updated');
            ob_start(); ?>
            <div class="wpc-shortcode-field">
                <p id="wpc-short-text">
                    [WPC_SHOW_CONTAINER cat-name="<?php echo esc_attr( $_POST['cat-name'] )?>" num-p="<?php echo esc_attr( $_POST["num-p"] )?>" p-order="<?php echo esc_attr( $_POST["p-order"] )?>"]
                </p>
                <span class="wpc-copy" data-clipboard-action="copy" data-clipboard-target="#wpc-short-text" style="cursor: pointer;">
                    <i class="far fa-clipboard"></i>
                </span>
            </div> <?php
            ob_end_flush();
        endif;
    endif;
}

/**
 * Show Category list function.
 *
 * @since 0.7.0
 * @since 2.1.0         Changed name from wpc_show_categories to slideIT_show_categories
 * 
 * @return string       Queries inside the WP DB and retrieve the
 *                      product categories inside an array.
 *                      Then returns it inside a option HTML tag
 *                      to be put inside a datalist.
 */
function slideIT_show_categories()
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
 * @since 2.1.0           Changed name from wpc_admin_style to slideIT_admin_style
 * 
 * @since 1.0.0           Updated format to better fit 
 *                        WordPress enqueueing in admin pages
 *                        and changed to admin-functions.php
 * @since 2.1.0           Added path to internal WP CliboardJS
 */
function slideIT_admin_style()
{
    // if page is set and is WPC admin page
    if ( isset( $_GET['page'] ) && @$_GET['page'] == 'slide-it' ):
        wp_enqueue_script( 'slideIT_ClipboardJS' ); //Calls WP included Clipboard JS
        wp_enqueue_script( 'fontawesome' );
        wp_enqueue_script( 'slideIT_admin', plugins_url( basename( slideIT_DIR ) . '/admin/slide-it-admin.js'), '', '1.0', true );
        wp_enqueue_style( 'slideIT_admin', plugins_url( 'style.css' , __DIR__ . '/admin' ), '', '2.0' );
        wp_enqueue_style( 'fontawesome' );
    endif;
}