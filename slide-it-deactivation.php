<?php
/**
 * Slide it! deactivation file.
 * It contains a couple routines to be made in case of plugin eactivation.
 * 
 * @author kesc23.
 * 
 * @since 1.0.0
 * @since 0.2.0 changed filename.
 */
if ( ! defined( 'ABSPATH' ) )
{
    exit;
}
/**
 * This Function is used in the deactivation process to dequeue
 * the styles and scripts.
 *
 * @since 1.0.0
 */
function wpcOnDeactivate()
{
    wp_dequeue_style( 'wpc_loop' );
    wp_dequeue_style( 'wpc_FA_font_style' );
    wp_dequeue_script( 'wpc_kit_fontawesome' );

    wp_deregister_style( 'wpc_loop' );
    wp_deregister_style( 'wpc_FA_font_style' );
    wp_deregister_script( 'wpc_kit_fontawesome' );
}

?>