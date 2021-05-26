<?php
if ( ! defined( 'ABSPATH' ) ){
    exit;
}?>

<header>
    <style>
        .wpc-scroller {
            width: 100%;
            overflow-x: scroll;
            display: block
        }
        @media only screen and (min-width: 768px){
            .wpc-scroller {
                width: 90%;
                overflow-x:
                unset;
                display: inline-block;
            }
            .woocommerce .products ul, .woocommerce ul.products {
                width: 90%!important;
            }
        }
        .woocommerce .products ul, .woocommerce ul.products {
            width: 125%;
        }
        .woocommerce .button {
            display: none!important;
        }
        .wpc-btn span{
            width: 10%;
        }
    </style>
</header>
