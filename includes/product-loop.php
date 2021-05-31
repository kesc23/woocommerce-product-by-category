<?php

if ( ! defined( 'ABSPATH' )){
    exit;
}


function wpc_scroller_start( string $wpc_start_category = null)
{
    if ($wpc_start_category == null){
        $wpc_start_category = 'Produtos';
    }
    $wpc_start_output = 
    '<div class="wpc wrap">
        <div class="wpc-cat">
            <h3 style="font-size: 21px; margin: 5px; font-weight: 600; text-transform: captalise">';
            $wpc_start_output .= $wpc_start_category . '</h3>
        </div>
        <span class="wpc-scroller">
            <span class="wpc-post-content">';
    return $wpc_start_output;
}


/**
 * 
 */
function wpc_scroller_routine( string $wpc_category_routine, int $wpc_routine_posts_to_show)
{   
    if ( $wpc_category_routine == null)
    {
        $wpc_category_routine = 0; //Display all Products if is empty
    }

    $wpc_product_query = new WP_Query(
        array(
            'post_type' => 'product',
            'product_cat' => $wpc_category_routine,
            'nopaging' => true
        )
    );
    
    if ( $wpc_product_query->have_posts() ) {

        $wpc_output = null;

        $wpc_post_count = 0;

        /**
         * THIS LOOP TESTS FOR THE POSTS IN QUERY
         * IT RETURNS A NUMBER TO BE USED IN CSS FOR MOBILE PHONES
         * 
         * @since 0.6.0
         */
        while ( $wpc_product_query->have_posts() )
        {
            $wpc_product_query->the_post();
            $wpc_post_count += 1;
        }

        if ($wpc_post_count >= 5){
            
            $wpc_post_count = 5;

        } elseif ($wpc_post_count < 5 AND $wpc_post_count >= 2)
        {
            switch ($wpc_post_count) {
                case 2:
                    $wpc_post_count = 2;
                    break;
                case 3:
                    $wpc_post_count = 3;
                    break;
                case 4:
                    $wpc_post_count = 4;
                    break;
            }
        }


        //MAIN LOOP

        $wpc_loop_counter = 0;
        while ( $wpc_loop_counter < $wpc_post_count /*$wpc_product_query->have_posts()*/ )
        {
            $wpc_loop_counter ++;
            $wpc_product_query->the_post();
            $wpc_output .= 
                '<li>
                    <a href="' . get_permalink() . '">
                        <img src="' . get_the_post_thumbnail_url() . '">
                        <h3 style="font-size: 18px;">' . get_the_title() . '</h3>
                    </a>
                </li>';
        }
        
    } else {

        // no posts found
        return 'Nenhum produto encontrado ';
    }

    /* Restore original Post Data */
    wp_reset_postdata();

    return $wpc_output;
}



function wpc_scroller_end( string $wpc_category_end = null)
{
    if ($wpc_category_end == null)
    {
        //Change the text for the slider
        $wpc_slider_link = 'Ver Produtos';

        $wpc_category_url = wc_get_page_permalink( 'shop' );
    
    } else {
        
        $wpc_slider_link = 'Veja Mais';

        $wpc_category_url = get_term_link( $wpc_category_end, 'product_cat' );
    
        if (is_object($wpc_category_url))
        {
            return $wpc_category_url = "<strong>ERROR</strong>: Categoria Não Encontrada" . "</span></span>";
        }
    }
    
    //Returns the Category Link
    

    return
    '           <span class="wpc-btn">
                    <a href="' . $wpc_category_url . '">
                        <i class="fas fa-arrow-right" style="font-size: 20px;"></i>'
                . $wpc_slider_link .
                    '</a>
                </span>
            </span>
        </span>
    </div>
    ';
}

/**
 * WPC GET TEMPLATE
 * 
 * @since 0.6.0
 */
function wpc_get_template(string $wpc_category = null, int $wpc_posts_to_show = null)
{   
    return wpc_scroller_start($wpc_category) . wpc_scroller_routine($wpc_category, $wpc_posts_to_show) . wpc_scroller_end($wpc_category);
}