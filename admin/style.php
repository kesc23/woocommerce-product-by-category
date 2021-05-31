<?php
/**
 * Stylesheet for the WPC admin page.
 * 
 * @author Kesc23
 * @since 0.7.0
 */


if ( ! defined( 'ABSPATH' ) || ! defined( 'WPCADMIN' ) ){
    exit; //exit if accessed directly.
}

/**
 * This function adds a stylesheet to the WPC admin page.
 *
 * @since 0.7.0
 * @return string returns the style for admin page
 */
function wpc_admin_style()
{
    $wpc_admin_style = '
    
        .wpc-table{
            border: 1px solid #cacaca;
            padding: 2px;
            margin: 5px auto;
            width: 85%;
        }
        
        table.wpc-table td, th{
            border: inherit;
        }
        
        span#wpc-generator{
            cursor: pointer;
        }
        .wpc.header {
            background-color: #fff;
            margin: 15px auto;
            max-width: 800px;
            text-align: center;
            border-radius: 8px;
        }
        /* div.wpc-shortcode-generator{
            display: flex;
        }
        div.wpc-shortcode-generator.lightbox{
            display: flex;
        } */
        .wpc-shortcode-generator.lightbox {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: unset;
            
            width: 100vw;
            height: 100vh;
            z-index: 999999;
            background-color: #FFF;
            
            background: rgb(0 0 0 / 41%);
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }
        .wpc-shortcode-generator form {
            z-index: 1000000;
            width: 480px;
            /* height: 200px; */
            background-color: #FFF;
            padding: 20px;
            padding-bottom: 0;
            border-radius: 6px;
            margin: 0px auto;
        }
        .wpc-shortcode-generator label {
            width: 100%;
            display: block;
            text-transform: capitalize;
            font-size: 16px;
            font-weight: 300;
        }
        .wpc-shortcode-generator input {
            padding: 5px;
            width: 100%;
        }
        .wpc-shortcode-generator button {
            /* display: block; */
            width: -webkit-fill-available;
            margin: 20px 100px;
            background-color: #07ffaa;
            color: #FFF;
            font-weight: 600;
            border: none 0px;
            padding: 8px;
            border-radius: 3px;
            box-shadow: 0px 3px 10px rgb(0 0 0 / 18%);
        }
        .wpc-shortcode-field {
            padding: 5px;
            text-align: center;
            background-color: #FFF;
            margin: 20px 0px;
            border-radius: 3px;
        }
    ';

    return '<style>' . $wpc_admin_style . '</style>';
}
?>