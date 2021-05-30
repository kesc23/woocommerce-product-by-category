# Wocommerce Product By Category

### Author: Kesc23

#### [MyTwitter](https://twitter.com/kevin_esc23)
#### [Fiverr](https://fiverr.com/kesc23)

#### Version 0.6.0
#### Changelog

- Independent From Woocommerce CSS Classes

By working my way trying to generate the loop with the Wordpress core `WP_Query()` class,
Now all CSS involving the product loop in our carrousel slider is independent.
Which will make easier to load this loop properly if you use Beaver Builder, Elementor and the Block Editor.

*Beaver Builder uses `display: flex;` while Elementor uses `display: grid;`*


> **Added special methods for outputting the loop**

```Php
/**
 * Gets the category name or return null
 * and open the loop block for the template
 */
function wpc_scroller_start();

/**
 * Gets most of the params from the master function
 * 'wcp_get_template'. Returns the loop for the plugin
 */
Function wpc_scroller_routine();

/**
 * Gets to generate the last part for the loop block
 * verifies if some error ocurred when parsing category name
 */    
function wpc_croller_end();

```

> **Added the master function to handle loop generation**

```php
/**
 * gets the params for generating the loop.
 * later will accept args from parent function
 * to work with the shortcode function 'wpc_shortcode_container'
 *
 * @since 0.6.0
 */
function wpc_get_template( string $wpc_category = null, int $wpc_posts_to_show = null)
{   
    return wpc_scroller_start($wpc_category) . wpc_scroller_routine($wpc_category, $wpc_posts_to_show) . wpc_scroller_end($wpc_category);
}
```

- Added Security measure from Requiring Woocommerce Active

When the plugin loads, it will automatically search for the status 'active'
from woocommerce.

If not, it shows an **error** and them shuts itself down. 

*If Woocommerce isn't installed and the plugin query its post_type, it would return a Fatal Error, giving the user a very **hard** time*

```php
/**
 * ACTION HOOK TO VERIFY IF WOOCOMMERCE IS ACTIVE
 * CASE FALSE, DISPLAY ERROR MESSAGE AND DEACTIVATE PLUGIN
 * 'wpc_show_messages' 
 *
 * @since 0.6.0
**/

if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) )
{
    do_action( 'admin_messages' , 'WooCommerce is not Activated. Please Activate Woocommerce', 'error');

    deactivate_plugins( 'woocommerce-product-by-category/woocommerce-product-by-category.php' );
}
```
