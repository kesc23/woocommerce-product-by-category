<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}


// Function to 
function wpc_show_messages( string $wpc_message, string $wpc_message_type)
{
    //error & class message variables
    $wpc_error = null;
    $wpc_message_class = null;

    if ($wpc_message_type == "error")
    {
        $wpc_message_class = '"error"';
        $wpc_error = "<strong>ERROR</strong>: ";
    } elseif ($wpc_message_type == update)
    {
        $wpc_message_class = '"error"';
    }
    
    echo ('<div class=' . $wpc_message_class . '><p>' . $wpc_error . $wpc_message . '</p></div>');
}

add_action( 'admin_messages', 'wpc_show_messages', 10, 2);