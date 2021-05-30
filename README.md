# Wocommerce Product By Category #

### Author: Kesc23 ###

#### [MyTwitter](https://twitter.com/kevin_esc23) ####
#### [Fiverr](https://fiverr.com/kesc23) ####

#### Version 0.6.0 ####
#### Changelog ####

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
 */
function wpc_get_template()
