<?php
if ( ! defined( 'ABSPATH' ))
{
    exit;
}
if ( ! defined( 'WPCADMIN' ))
{
    exit;
}


require_once WPCADMIN . 'admin-functions.php';

require_once WPCADMIN . 'style.php';

/**
 * Calls the admin stylesheet.
 * 
 * @see admin/style.php
 */
echo wpc_admin_style();
?>



<div class="wpc header">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <p>Hello</p>
</div>


<style>
    span#wpc-generator:active .wpc-shortcode-generator{
        display: flex;
    }
</style>
<span ID="wpc-generator">Gerar Shortcode</span>

<?php 
    echo wpc_display_shortcode();
?>

<div class="wpc-shortcode-generator" id="wpc-light" onclick="wpc_light_out()">
    <!-- <h3>[WPC_PRODUCT_SHORTCODE cat-name="<span id="wpc-cat-name"></span>" ]</h3> -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="wpc-form">
        
        <label for="cat-name">Nome Da Categoria</label>
            <input type="text" name="cat-name" id="cat-name" placeholder="e.g. Pet-Shop">
        
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

<script>

// function wpc_light_in()
// {
//     var element = document.getElementById("wpc-light");
//     element.classList.add("lightbox");
// }

// function wpc_light_out()
// {
//     var wpc_form = document.getElementById("wpc-form");

//     function wpc_return()
//     {
//         return 1;
//     }

//     wpc_form.onclick = null;

//     wpc_form = wpc_return();

//     if (wpc_form = 1) {
//         return;
//     } else {
      
//         var element = document.getElementById("wpc-light");
//         element.classList.remove("lightbox");
//     }
    
// }
</script>