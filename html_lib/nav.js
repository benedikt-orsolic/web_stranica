var show = 1;
    
function togleMenu() {
    
    var navElements =  document.getElementsByClassName('navLink');
    var len = navElements.length;
    var i;

    if ( show ) {
        for( i=1; i < len; i++ ) {
            navElements[i].style.display = 'none';
        }
        show = 0;
    } else {
        for( i=1; i < len; i++ ) {
            navElements[i].style.display = 'block';
        }
        show = 1;
    }
}