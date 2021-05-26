<?php
if ( ! defined( 'ABSPATH' ) ){
    exit;
}
?>
<div class="main wrap">
    <span class="wpc-scroller">
        <?php echo do_shortcode( '[products limit="10" columns="5"]' );?>
    </span>
    <span class="wpc-btn">'
        <a href="">
            <span class="dashicons dashicons-arrow-right-alt"></span>'
        </a>
    </span>
</div>
