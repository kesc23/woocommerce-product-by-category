<?php
if ( ! defined( 'ABSPATH' ) ||  ! defined( 'slideIT_ADMIN' ) )
{
    exit;
}

require_once slideIT_ADMIN . 'admin-functions.php';

?>
<script>
    // instance of the clipboard
    var wpcShort = new ClipboardJS('.wpc-copy');
</script>

<div style="margin: 10px 20px 0 2px;">

    <div class="wpc header">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p>Hello, You!</p>
    </div>


    <style>
        span#wpc-generator:active .wpc-shortcode-generator{
            display: flex;
        }
    </style>
    
    <?php 
        echo slideIT_display_shortcode();
    ?>

    <div class="wpc-shortcode-generator" id="wpc-light">
        <!-- <h3>[WPC_PRODUCT_SHORTCODE cat-name="<span id="wpc-cat-name"></span>" ]</h3> -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="wpc-form">
            
            <label for="cat-name">Category Name</label>
                <input type="text" list="wpc-cat-list" name="cat-name" id="cat-name" placeholder="e.g. Pet-Shop">
                <datalist id="wpc-cat-list">
                    <?php echo slideIT_show_categories();?>
                </datalist>

            <label for="num-p">Number of products</label>
                <input type="number" name="num-p" id="num-p" step="1" value="5" placeholder="5">
            
            <label for="p-order">Order By Name</label>
                <select name="p-order" id="p-order">
                    <option value="ASC" selected>Ascendent</option>
                    <option value="DESC">Descendent</option>
                </select>
            <button type="submit" style="cursor: pointer;">Create !</button>
        </form>
    </div>
</div>