var shortCodeform = document.getElementById( 'wpc-form' );
var theButton     = document.getElementById( 'submit' );

shortCodeform.addEventListener( 'submit', postShortcode);
theButton.addEventListener( 'click', loadingCursor );

function postShortcode(e)
{
    e.preventDefault();

    $xhr = new XMLHttpRequest();
    
    var catName = document.getElementById( 'cat-name' ).value;
    var numP    = document.getElementById( 'num-p' ).value;
    var pOrder  = document.getElementById( 'p-order' ).value;

    $theData =
    {
        "cat_name": catName,
        "num_p": numP,
        "p_order":  pOrder
    };
    
    var $params = "shortcode-data=" + JSON.stringify( $theData );

    $xhr.open('POST', document.URL, true);
    $xhr.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded');
    $xhr.onload = function(){

        if( this.status == 200 )
        {
            let responseElement       = document.createElement('div');
            responseElement.classList.add( 'slide-it-response' );
            responseElement.innerHTML = this.response;

            document.getElementById( 'shortcode-field' ).innerHTML = responseElement.innerHTML;

            document.body.style.cursor = 'unset';
        }

        if( this.status != 200 )
        {
            document.getElementById( 'shortcode-field' ).innerHTML = '<strong>Something Just Went Wrong</strong>';
        }
    };

    $xhr.send($params);
}

function loadingCursor()
{
    document.body.style.cursor = 'progress';
}