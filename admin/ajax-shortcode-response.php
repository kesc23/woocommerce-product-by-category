<?php
if( ! defined( 'ABSPATH' ) || ! defined( 'slideIT_ADMIN' ) ): exit; endif;

/**
 * Create a way to display a formated message inside wordpress.
 */
function slideIT_messages( string $wpc_message, string $wpc_message_type)
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

function slideITErrorMessage( $message )
{
    return slideIT_messages( $message, 'error' );
}

function slideITAprovedMessage( $message )
{
    return slideIT_messages( $message, 'updated' );
}

/**
 * This function is used to return the shortcode generated. it similar to methods used in the past,
 * but now it does work using ajax (so you dont have to reload the page to generate 2+ shortcodes).
 * 
 * @since 2.2.0
 *
 * @return void
 */
function slide_it_shortcode_generator_ajax()
{
    // if we receved the data from ajax, we start the process.
    if( isset( $_POST['shortcode-data'] ) ):
        $dataClean = $_POST['shortcode-data'];
        if( strpos( $dataClean, '\\' ) ):
            $dataClean = str_replace( "\\", '', $_POST['shortcode-data'] ); //it cleans escaped JSON objects.
        endif;
    else:
        return;
    endif;
    
    $shortcodeData = json_decode( $dataClean );

    $theData = array(
        'cat-name' => $shortcodeData->cat_name,
        'num-p'    => intval( $shortcodeData->num_p ),
        'p-order'  => $shortcodeData->p_order
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
        echo slideITErrorMessage( 'Category not inserted' ); // returns error if category name is not set
    elseif ( ! in_array( $theData['cat-name'], $notEmptyCategories ) ):
        echo slideITErrorMessage( 'Category entered is empty or invalid' );
    elseif ( $theData['num-p'] <= -2 ):
        echo slideITErrorMessage( 'Invalid Number' ); // returns error if num-p is less than 2. -1 has a role.
    else:
        echo slideITAprovedMessage( 'This is yours shortcode. Put it in the desired page' );
        ob_start(); ?>
        <div class="wpc-shortcode-field">
            <p id="wpc-short-text">
                [WPC_SHOW_CONTAINER cat-name="<?php echo esc_attr( $theData['cat-name'] )?>" num-p="<?php echo esc_attr( $theData["num-p"] )?>" p-order="<?php echo esc_attr( $theData["p-order"] )?>"]
            </p>
            <span class="wpc-copy" data-clipboard-action="copy" data-clipboard-target="#wpc-short-text" style="cursor: pointer;">
                <i class="far fa-clipboard"></i>
            </span>
        </div> <?php
        ob_end_flush();
    endif;
    die();
}