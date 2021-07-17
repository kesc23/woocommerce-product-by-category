<?php 
if ( ! defined( 'ABSPATH' ) ||  ! defined( 'slideIT_ADMIN' ) ): exit; endif;
?>
<script>
var shortCodeform = document.getElementById( 'wpc-form' );
var theButton     = document.getElementById( 'submit' );

//theButton.addEventListener( 'click', slideItAuth );
shortCodeform.addEventListener( 'submit', postShortcode);
theButton.addEventListener( 'click', loadingCursor );

function postShortcode(e)
{
    e.preventDefault();

    $xhr = new XMLHttpRequest();
    
    var catName = document.getElementById( 'cat-name' ).value;
    var numP    = document.getElementById( 'num-p' ).value;
    var pOrder  = document.getElementById( 'p-order' ).value;
    var cards   = document.getElementById( 'cards' ).value;

    $theData =
    {
        "cat_name": catName,
        "num_p"   : numP,
        "p_order" : pOrder,
        "cards"   : cards,
    };
    
    var $params = "shortcode-data=" + JSON.stringify( $theData );

    $xhr.open('POST', document.URL, true);
    $xhr.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded');
    $xhr.setRequestHeader( 'Authorization', '<?php global $slide_it_version, $slide_it_time; echo "SLIDE-IT{$slide_it_version}{$_SERVER['SERVER_NAME']}{$slide_it_time}";?>');
    $xhr.onload = function(){

        if( this.status == 200 || this.status == 400 )
        {
            let responseElement       = document.createElement('div');
            responseElement.classList.add( 'slide-it-response' );
            responseElement.innerHTML = this.response;

            document.getElementById( 'shortcode-field' ).innerHTML = responseElement.innerHTML;

            document.body.style.cursor = 'unset';
        }else{
            document.getElementById( 'shortcode-field' ).innerHTML = '<strong>Something Just Went Wrong</strong>';
        }
    };

    $xhr.send($params);
}

function loadingCursor()
{
    document.body.style.cursor = 'progress';
}
</script>