<?php
if ( ! defined( 'ABSPATH' ) ||  ! defined( 'WPCADMIN' ) )
{
    exit;
}

require_once WPCADMIN . 'admin-functions.php';

require_once WPCADMIN . 'style.php';

wp_enqueue_style( 'wpc_FA_font_style' );

/**
 * Calls the admin stylesheet.
 * 
 * @see admin/style.php
 */
echo wpc_admin_style();
?>
<!-- Loads Clipboard Functionality -->
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>

<script>
    // instance of the clipboard
    var wpcShort = new ClipboardJS('.wpc-copy');
</script>

<div style="margin: 10px 20px 0 2px;">

    <div class="wpc header">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p>Hello</p>
    </div>


    <style>
        span#wpc-generator:active .wpc-shortcode-generator{
            display: flex;
        }
    </style>
    
    <?php 
        echo wpc_display_shortcode();       
    ?>

    <div class="wpc-shortcode-generator" id="wpc-light">
        <!-- <h3>[WPC_PRODUCT_SHORTCODE cat-name="<span id="wpc-cat-name"></span>" ]</h3> -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="wpc-form">
            
            <label for="cat-name">Nome Da Categoria</label>
                <input type="text" list="wpc-cat-list" name="cat-name" id="cat-name" placeholder="e.g. Pet-Shop">
                <datalist id="wpc-cat-list">
                    <?php echo wpc_show_categories();?>
                </datalist>

            <label for="num-p">Número de Produtos</label>
                <input type="number" name="num-p" id="num-p" step="1" value="5" placeholder="5">
            
            <label for="p-order">Ordenar Por Nome</label>
                <select name="p-order" id="p-order">
                    <option value="ASC" selected>Ascendente</option>
                    <option value="DESC">Descendente</option>
                </select>
            <button type="submit" style="cursor: pointer;">Criar</button>
        </form>
    </div>
</div>

