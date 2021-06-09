<?php

/**
 * This Function is used in the deactivation process to dequeue
 * the styles and scripts.
 *
 * @since 0.9.0
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