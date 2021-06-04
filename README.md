# WooCommerce Product By Category

### Author: Kesc23
| Twitter | Fiverr |
|-|-:|
| [@kevin_esc23](https://twitter.com/kevin_esc23) | [/kesc23](https://fiverr.com/kesc23)|

### Version 0.8.0
#### Changelog

### *Desktop Update*
- Changed the way Scrollbars look in Desktop

```css
    .wpc-scroller::-webkit-scrollbar{
        background-color: rgb(209, 209, 209);
        height: 8px;
        display: block;
        border-radius: 100vh;
     }
     .wpc-scroller::-webkit-scrollbar-thumb{
        background-color: rgb(150, 150, 150);
        border-radius: 100vh;
        max-height: 3px;
     }
     .wpc-scroller::-webkit-scrollbar-thumb:active{
        background-color: rgb(70, 70, 70);
     }
```

By resizing and adding some styles in the scrollbar, 
we could make something that fit the style we wanted to the plugin. 
Now we do recommend that you put more than 5 products to show in the desktop

- Changed Product Loop photo size and card size

By adding the last update, we focused in founding a card size that would fit great 5 products in the loop for a minimum 1024px width resolution.

with this, we upgraded the photo size to 190px and now it all fits great.