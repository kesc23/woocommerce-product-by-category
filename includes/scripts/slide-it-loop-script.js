$scrollers = [];

$scrollers = Array.from( document.getElementsByClassName( 'wpc-scroller' ) );

/**
 * This routine changes scrollbars visibility while mouse over.
 */
$scrollers.forEach( scroller => {
    scroller.addEventListener(
        'mouseover', () => { 
            scroller.classList.add( 'scrollVisible' );
        }
    );
    
     scroller.addEventListener(
        'mouseout', () => {
            scroller.classList.remove( 'scrollVisible' );
        }
    );
});

/**
 * The major part in the code below belongs to https://htmldom.dev/drag-to-scroll/.
 */
$scrollers.forEach( draggable => {

        const mouseDownHandler = function( element ) {
            let pos = {left: 0, x: 0};
    
            draggable.style.cursor     = 'grabbing';
    
            pos = {
                left: draggable.scrollLeft,
                x: element.clientX,
            };
    
            const mouseMoveHandler = ( element ) => {
                const deltaX = element.clientX - pos.x;
                draggable.scrollLeft = pos.left - deltaX;
            };
    
            const mouseUpHandler =() => {
                draggable.style.cursor = 'grab';
                
                draggable.removeEventListener( 'mousemove', mouseMoveHandler );
                draggable.removeEventListener( 'mousedown', mouseDownHandler );
                draggable.addEventListener( 'mousedown', mouseDownHandler );
            };
    
            draggable.addEventListener( 'mousemove', mouseMoveHandler );
            draggable.addEventListener( 'mouseup', mouseUpHandler );
        };
    
        draggable.addEventListener( 'mousedown', mouseDownHandler );
});