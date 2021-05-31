# Wocommerce Product By Category

### Author: Kesc23
| Twitter | Fiverr |
|-|-:|
| [@kevin_esc23](https://twitter.com/kevin_esc23) | [/kesc23](https://fiverr.com/kesc23)|

#### Version 0.7.0
#### Changelog

- Changed admin style from 'style.css' to 'style.php'

Altough this seems like a strange idea, i kinda couldn't work my way to add styles
in the WPC admin page inside WordPress.

The method used was by means of using action hooks from WP.

As i can print out info from php code inside the admin page i thought *i can work my way **creating a function to print style***

```php
/**
 * This function adds a stylesheet to the WPC admin page.
 *
 * @since 0.7.0
 * @return string returns the style for admin page
 */
function wpc_admin_style()
{
    $wpc_admin_style = '
      // Style inside
    ';

    //returns a HTML style tag to print the stylesheet inline
    return '<style>' . $wpc_admin_style . '</style>';
}
?>
```

Then, all i need to do is echo out this function inside my admin page:

```php
//inside adminpage.php
    require_once WPCADMIN . 'style.php';

    echo wpc_admin_style();
```

