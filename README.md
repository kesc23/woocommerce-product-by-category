# Slide it! - Slider for WooCommerce

### Author: Kesc23
| Twitter | Fiverr |
|-|-:|
| [@kevin_esc23](https://twitter.com/kevin_esc23) | [/kesc23](https://fiverr.com/kesc23)|

### Version 2.1.3
#### Changelog
- changed function 
```php
slideIT_activated()
```
As it was causing a fatal error. 

### From 2.1.2
- Fixed error message not appearing while trying to star Slide It without WooCommerce

#### From 2.1.1

- Renamed some hook handles

#### From 2.1.0:
##### Several Changes to be compliant with WP Standards:
- changed filenames
```
wpc-functions to slide-it-functions
wpc-shortcodes to slide-it-shortcodes
wpc_loop to slide-it-loop
```
- Changed constants
```
WPCDIR to slideIT_DIR
WPCADMIN to slideIT_ADMIN
WPCINC to slideIT_INC
```
- Changed function Names
```
wpc_add_menu to slideIT_add_menu
wpc_admin_page to slideIT_admin_page
wpc_scripts_register to slideIT_scripts_register
wpc_scripts to slideIT_scripts
wpc_shortcode_container to slideIT_shortcode_container
wpc_get_template to slideIT_get_template
wpc_activated to slideIT_activated
wpc_scroller_start to slideIT
wpc_scroller_routine to slideIT
wpc_scroller_end to slideIT_scroller_end
wpc_show_messages to slideIT_show_messages
wpc_diplay_shortcode to slideIT_diplay_shortcode
wpc_show_categories to slideIT_show_categories
wpc_admin_style to slideIT_admin_style
wpcOnDeactivate to slideITOnDeactivate
```
- Changed some Hook handle names
- Some Other changes
```
Now using the anonymous, CDN version of FontAwesome, improving safety.
Using Internal WP ClipboardJS
```
