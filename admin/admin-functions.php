<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}


// Function to 
function wpc_show_messages( string $wpc_message, string $wpc_message_type)
{
    //error message variable
    $wpc_error = null;

    if ($wpc_message_type == error)
    {
        $wpc_message_class = '"error"';
        $wpc_error = "<strong>ERROR</strong>";
    } elseif ($wpc_message_type == update)
    {
        $wpc_message_class = '"error"';
    }
    
    ob_start();?>
    <div class=<?php echo $wpc_message_class ?>>
        <p><?php echo $wpc_error . $wpc_message ?></p>
    </div>
    <?php
        echo ob_get_clean();
    
    //deactivate_plugins( 'Woocommerce Product By Category', bool $silent = false, bool|null $network_wide = null )
}

add_action( 'admin_messages', 'wpc_show_messages', 10, 2);