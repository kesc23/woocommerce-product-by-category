<?php
if( ! defined( 'ABSPATH' ) || ! defined( 'slideIT_ADMIN' ) ): exit; endif;

/**
 * Create a way to display a formated message inside wordpress.
 *
 * @param  string $wpc_message         The message to be sent.
 * @param  string $wpc_message_type    Tthe message type.
 * @return string
 */
function slideIT_messages( string $wpc_message, string $wpc_message_type) : string
{
    //error & class message variables
    $wpc_error = null;
    $wpc_message_class = null;

    $wpc_message = esc_attr( $wpc_message ); //escaping the message for WP.

    if ($wpc_message_type == "error"):
        $wpc_message_class = 'error notice is-dismissible';
        $wpc_error         = "ERROR: ";
    else:
        $wpc_message_class = 'updated notice is-dismissible';
    endif;
    //$wpc_message_class && $wpc_error are only used internally by the function.
    ob_start();?>
    <div class="<?php echo $wpc_message_class; ?>">
        <p><strong><?php echo $wpc_error; ?></strong><?php echo $wpc_message; ?></p>
    </div>
    <?php
    $message = ob_get_clean();
    return $message;
}

/**
 * This function returns an error message inside wordpress.
 * it's meant to be used inside the wp-admin.
 *
 * @param  string $message
 * @return string
 */
function slideITErrorMessage( string $message ) : string
{
    return slideIT_messages( $message, 'error' );
}

/**
 * This function returns an aproved/updated message inside wordpress.
 * it's meant to be used inside the wp-admin.
 *
 * @param  string $message
 * @return string
 */
function slideITAprovedMessage( string $message ) : string
{
    return slideIT_messages( $message, 'updated' );
}


/**
 * This function is used to return the shortcode generated. it similar to methods used in the past,
 * but now it does work using ajax (so you dont have to reload the page to generate 2+ shortcodes).
 * 
 * @since 2.2.0
 * @return string
 */
function slide_it_shortcode_generator_ajax() : string
{
    global $slide_it_version, $slide_it_time;

    if( ! isset( $_GET['page'] ) || 'slide-it' != @$_GET['page'] ): return ''; endif;
    if( empty( $_SERVER['HTTP_AUTHORIZATION'] ) ):
        header( "User-Agent: Slide it! Shortcode Generator", true, 401 );
        return '';
    endif;
    if( ! $_SERVER['HTTP_AUTHORIZATION'] == 'SLIDE-IT'.$slide_it_version.$_SERVER['SERVER_NAME'].$slide_it_time ):
        header( "User-Agent: Slide it! Shortcode Generator", true, 401 );
        return '';
    endif;

    if( ! is_admin() ): header( "User-Agent: Slide it! Shortcode Generator", true, 403 ); die; endif;

    // if we receved the data from ajax, we start the process.
    if( isset( $_POST['shortcode-data'] ) ):
        $dataClean = $_POST['shortcode-data'];
        if( strpos( $dataClean, '\\' ) ):
            $dataClean = str_replace( "\\", '', $_POST['shortcode-data'] ); //it cleans escaped JSON objects.
        endif;
    else:
        return '';
    endif;
    
    $shortcodeData = json_decode( $dataClean );

    $theData = array(
        'cat-name' => $shortcodeData->cat_name,
        'num-p'    => intval( $shortcodeData->num_p ),
        'p-order'  => $shortcodeData->p_order,
        'cards'    => $shortcodeData->cards,
    );

    //Obtaining the name of valid, non-empty categories.
    $cat_list = get_categories(
        array(
            'taxonomy'=> 'product_cat'
        )
    );

    foreach( $cat_list as $validCategory ):
        $notEmptyCategories[] = $validCategory->name;
    endforeach;

    if ( $theData['cat-name'] == '' || $theData['cat-name'] == null ):
        header( "User-Agent: Slide it! Shortcode Generator", true, 400 );
        echo slideITErrorMessage( 'Category not inserted' ); // returns error if category name is not set
    elseif ( ! in_array( $theData['cat-name'], $notEmptyCategories ) ):
        header( "User-Agent: Slide it! Shortcode Generator", true, 400 );
        echo slideITErrorMessage( 'Category entered is empty or invalid' );
    elseif ( $theData['num-p'] <= -2 ):
        header( "User-Agent: Slide it! Shortcode Generator", true, 400 );
        echo slideITErrorMessage( 'Invalid Number' ); // returns error if num-p is less than 2. -1 has a role.
    else:
        header( "User-Agent: Slide it! Shortcode Generator", true, 200 );
        echo slideITAprovedMessage( 'This is yours shortcode. Put it in the desired page.' );
        $category     = esc_attr( $theData['cat-name'] );
        $numProducts  = esc_attr( $theData['num-p'] );
        $productOrder = esc_attr( $theData['p-order'] );
        $cards        = esc_attr( $theData['cards'] );
        ob_start(); ?>
        <div class="wpc-shortcode-field">
            <p id="wpc-short-text">
                [SLIDEIT_SHOW_CONTAINER cat-name="<?php echo $category;?>" num-p="<?php echo $numProducts;?>" p-order="<?php echo $productOrder;?>" cards="<?php echo $cards;?>"]
            </p>
            <span class="wpc-copy" data-clipboard-action="copy" data-clipboard-target="#wpc-short-text" style="cursor: pointer;">
                <i class="far fa-clipboard"></i>
            </span>
        </div> <?php
        ob_end_flush();
    endif;
    die();
}