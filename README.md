# Slide it! - Slider for WooCommerce

### Author: Kesc23
| Twitter | Fiverr |
|-|-:|
| [@kevin_esc23](https://twitter.com/kevin_esc23) | [/kesc23](https://fiverr.com/kesc23)|

### Version 2.2.0
#### Changelog

- Changed shortcode generation form to include the new Card Styles.
Now we do got a new Shortcode Generator form, that uses AJAX to request our shortcodes.

Since this version we're no longer using ```[WPC_SHOW_CONTAINER]``` as it is from the older versions of the plugin.

- Created the new ```[SLIDEIT_SHOW_CONTAINER]```.
Now for using the full integration with cards functionallity.
The old ```[WPC_SHOW_CONTAINER]``` still works to support users with v2.1.3 and earlier, but without the cards.

- Added the Seamless Card style.

- Added Dummy product image.
While developing we notice that product cards without images would be hideous.
To fix this we added a dummy image saying "no image".