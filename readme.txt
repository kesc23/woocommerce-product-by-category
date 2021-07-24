=== Slide It! ===
Contributors: kesc23
Tags: slider, woocommerce, store, online, slide-it, css slider, scroll slider, slider for wordpress, slide
Tested up to: 5.8
Stable tag: 2.3.0
Requires at least: 4.6
Requires PHP: 7.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Let's add life to your online store with a beautiful product slider.

== Description ==

Let's add life to your woocommerce store with an outstanding product slider

* Create Your Slider
Select from all of your product categories *(the empties will not appear)* and
limit the products shown in the loop.

* No need to Worry in Smartphones
WPC was build with a mobile 1st design from start, so you'll not have 
any problems of compatibility with the sliders in mobile.

== Screenshots ==

1. Mobile view of the sliders

2. The Slide it shortcode generator

3. The shortcode after generation: ready to be copied

4. The sliders inside the site

5. Final mobile view of the sliders

== Changelog ==

= 2.3.0 =
* Prepared plugin for internationalization (i18n).

= 2.2.0 =
* Changed shortcode generation form to include the new Card Styles.
* Created the new [SLIDEIT_SHOW_CONTAINER]. The old [WPC_SHOW_CONTAINER] still works but without the cards.
* Added the Seamless Card style.
* Added the Dummy Product image.

= 2.1.3 =
* fixed bug causing fatal error while loading the plugin

= 2.1.2 =
* Fixed warning about WooCommerce dependency.

= 2.1.1 =
* Renamed some hook handles

= 2.1.0 =
* Changed names of several archives, handles, functions, constants to avoid errors in wp execution
* Now loading some libraries directly from WP.

= 2.0.0 =
* Re branded the plugin.
* Fixed problem with shortcodes carrying non-existent or empty categories.

= 1.0.1 =
* Fixed problem causing `FATAL ERROR` while activating the plugin

= 1.0.0 =
* Created wpc-deactivation.php file, creating a routine to dequeue and deregister scripts and css files from WPC on deactivation.
* deleted wpc_loop_elementor.css as it is not needed anymore.

= 0.8.1 =
* Fixed error in shortcode generator. The user was unable to select how many products would have to appear in a row.

= 0.8.0 =
* Changed the way Scrollbars look in Desktop. Now they're cool :)
By resizing and adding some styles in the scrollbar:
we could make something that fit the style we wanted to the plugin.
Now we do recommend that you put more than 5 products to show in the desktop

* Changed Product Loop photo size and card size:
By adding the last update, we focused in founding a card size that would fit great 5 products in the loop for a minimum 1024px width resolution. With this, we upgraded the photo size to 190px and now it all fits great.

== Upgrade Notice ==

= 2.2.0 =
Added Cards functionality & AJAX Shortcode Generator.

= 2.1.0 =
Rebranded the plugin, several files renamed. No backwards compatibility.

= 0.7.0 =
Using own css for loop generation. This helps to be compatible with Beaver Builder and Elementor, as woocommerce generated - at this time - the product loop in different ways (flex for BB and grid for EL).