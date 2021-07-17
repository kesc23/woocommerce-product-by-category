<?php

if( ! defined( 'ABSPATH' ) ): exit; endif;

/**
 * This function creates the first HTML tags of the scroller box.
 *
 * @since 0.6.0
 * @since 2.1.0     changed name from wpc_scroller_start to slideIT_scroller_start
 * 
 * @deprecated @since 2.2.0 @see slideITScrollerStart()
 * 
 * @param string $wpc_start_category
 * @return void
 */
function slideIT_scroller_start( string $wpc_start_category = null)
{
    if ($wpc_start_category == null){
        $wpc_start_category = 'Produtos';
    }
    ob_start(); ?>
    <div class="wpc wrap">
        <div class="wpc-cat">
            <h3 style="font-size: 21px; margin: 5px; font-weight: 600; text-transform: captalise">
                <?php echo esc_html( $wpc_start_category ); ?>
            </h3>
        </div>
        <span class="wpc-scroller">
            <span class="wpc-post-content">
    <?php $wpc_start_output = ob_get_clean();
    return $wpc_start_output;
}


/**
 * The scroller box function.
 *
 * @since 0.6.0
 * 
 * @param  string $wpc_category_routine              Is the category to be queried
 * @param integer $wpc_routine_posts_to_show         Is the 'limiter' for posts
 *                                                   to show inside the loop.
 * @since 0.7.0   @param  string $wpc_routine_order  Is to order, by name if is ASC or DESC
 * @since 2.1.0   changed name from wpc_scroller_routine to slideIT_scroller_routine
 * 
 * @return string
 */
function slideIT_scroller_routine( string $wpc_category_routine, int $wpc_routine_posts_to_show, string $wpc_routine_order)
{   
    if ( $wpc_category_routine == null)
    {
        $wpc_category_routine = 0; //Display all Products if is empty
    }

    /**
     * Queries, inside the WP DB, for:
     * posts of type 'product'
     * ordered by 'name'
     */
    $wpc_product_query = new WP_Query(
        array(
            'post_type'     => 'product',
            'product_cat'   => $wpc_category_routine,
            'nopaging'      => true,
            'orderby'       => 'title',
            'order'         => $wpc_routine_order
        )
    );
    
    if ( $wpc_product_query->have_posts() ) {

        $wpc_output = null;

        $wpc_post_count = 0;

        /**
         * This loop tests for the posts in query.
         * It returns a number to calculate the number of posts displayed if
         * the @param $wpc_routine_posts_to_show is passed. 
         */
        while ( $wpc_product_query->have_posts() )
        {
            $wpc_product_query->the_post();
            $wpc_post_count += 1;
        }
        
        /**
         * This "if" section is to always set up the lowest number
         * of products in the query.
         * 
         * @since 0.7.0
         * 
         * For example: if the @var $wpc_routine_posts_to_show
         * is > the max post count, and this goes inside the loop
         * the WordPress will return an error in the page with the shortcode
         * as it is trying to show a unexistent product.
         * For the functionality sake, using those parameters to limit them
         * to 'themselves' is the best option.
         */

        if( isset( $wpc_routine_posts_to_show ) ):
            if( $wpc_routine_posts_to_show == $wpc_post_count ):
                $wpc_post_count = $wpc_post_count;
            else:
                $wpc_post_count = min($wpc_routine_posts_to_show, $wpc_post_count);
            endif;
        endif;


        /**
         * MAIN LOOP
         * @since 2.2.0 the product image is now outside the <a> tag for a better scrollable element
         */
        $wpc_loop_counter = 0;
        while ( $wpc_loop_counter < $wpc_post_count /*$wpc_product_query->have_posts()*/ )
        {
            $wpc_loop_counter ++;
            $wpc_product_query->the_post();
            ob_start(); ?>
                <li>
                    <img src="<?php
                        if( ! get_the_post_thumbnail_url() ):
                            echo plugins_url( basename( slideIT_DIR ) ) . '/includes/images/dummy-image.png';
                        else:
                            echo get_the_post_thumbnail_url();
                        endif;
                    ?>">
                    <a href="<?php echo get_permalink(); ?>">
                        <h3 style="font-size: 18px;"><?php echo get_the_title(); ?></h3>
                    </a>
                </li>
        <?php $wpc_output .= ob_get_clean();
        }
        
    } else {

        // no posts found
        return 'Nenhum produto encontrado ';
    }

    /* Restore original Post Data */
    wp_reset_postdata();

    return $wpc_output;
}



function slideIT_scroller_end( string $wpc_category_end = null)
{
    if ($wpc_category_end == null)
    {
        //Change the text for the slider
        $wpc_slider_link = '<p>Show Products</p>';

        $wpc_category_url = wc_get_page_permalink( 'shop' );
    
    } else {
        
        $wpc_slider_link = '<p>See More</p>';

        $wpc_category_url = get_term_link( $wpc_category_end, 'product_cat' );
    
        if (is_object($wpc_category_url))
        {
            return $wpc_category_url = "<strong>ERROR</strong>: Category Not found!" . "</span></span>";
        }
    }
    
    //Returns the Category Link
    ob_start(); ?>
                <span class="wpc-btn">
                    <a href="<?php echo $wpc_category_url; ?>">
                        <span class="slide-it-more-logo">
                            <i class="fas fa-arrow-right" style="font-size: 20px;"></i>
                        </span>
                        <?php echo $wpc_slider_link; ?>
                    </a>
                </span>
            </span>
        </span>
    </div>
    <?php $scrollerEnd = ob_get_clean();
    return $scrollerEnd;
}

/**
 * WPC GET TEMPLATE
 * 
 * @since 0.6.0
 * @since 2.1.0                         Changed name from wpc_get_template to slideIT_get_template
 * 
 * @param string $wpc_category          The category name Passed in the Shortcode.
 *                                      If none is passed, it will return all the
 *                                      Products.
 * @param    int $wpc_posts_to_show     The max. number of posts to show. If value
 *                                      is not passed, it will limit them to 5
 * @param string $wpc_p_order           The order that posts should appear
 * 
 * @return string                       Returns the concatenation of all requested
 *                                      subfunctions into a beautiful post carousel.
 */
function slideIT_get_template(string $wpc_category = null, int $wpc_posts_to_show = 5, string $wpc_p_order = 'ASC')
{   
    return slideIT_scroller_start($wpc_category) . slideIT_scroller_routine($wpc_category, $wpc_posts_to_show, $wpc_p_order) . slideIT_scroller_end($wpc_category);
}


function slideITGetTemplate( $category, $postsToShow, $productOrder, $cards = null )
{
    return slideITScrollerStart( $category, $cards ) . slideIT_scroller_routine( $category, $postsToShow, $productOrder ) . slideIT_scroller_end( $category );
}

/**
 * This function creates the first HTML tags of the scroller box.
 * It is the new, almost identical as its predecessor. The new version
 * can handle the task of multicard / CSS classes to the scrollers.
 *
 * @since 2.2.0
 * 
 * @param  string $category     The category inserted in the shortcode
 * @param  string $cards        The card style for display
 * @return
 */
function slideITScrollerStart( string $category = null, string $cards = 'wpc-post-content' )
{
    if ($category == null)
    {
        $category = 'Products';
    }

    $selector = null;

    switch( $cards ){

        case 'card-style':
            $selector = 'card-style';
            break;

        case 'seamless':
            $selector = 'seamless';
            break;
        
        case 'glass-style':
            $selector = "glass-style";
            break;

        default:
            $selector = 'wpc-post-content';
            break;
    }


    ob_start(); ?>
    <div class="wpc wrap">
        <div class="wpc-cat">
            <h3 style="font-size: 21px; margin: 5px; font-weight: 600; text-transform: captalise">
                <?php echo esc_html( $category ); ?>
            </h3>
        </div>
        <span class="wpc-scroller">
            <span class="<?php echo $selector; ?>">
                <?php
    $theLoopStart = ob_get_clean();

    return $theLoopStart;

}