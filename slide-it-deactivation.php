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
 * @since 2.1.0 changed name from wpcOnDeactivate to slideITOnDeactivate
 */
function slideITOnDeactivate()
{
    wp_dequeue_style( 'slideIT_loop' );
    wp_dequeue_style( 'slideIT_FA_font_style' );
    wp_dequeue_script( 'slideIT_kit_fontawesome' );

    wp_deregister_style( 'slideIT_loop' );
    wp_deregister_style( 'slideIT_FA_font_style' );
    wp_deregister_script( 'slideIT_kit_fontawesome' );
}

?>