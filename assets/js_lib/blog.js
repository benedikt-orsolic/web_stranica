

function getNextToLastPost( lastPostUPID ) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML += this.responseText;
        }
    };

    xhttp.open('POST', 'assets/php_lib/get_blog_post.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&getBlogPost=1&upid=' + lastPostUPID );
}

function getUpidOfLastPost() {
    var error = 0;
    try {
        var lastChild = document.getElementById("main").lastChild.getAttribute("id");
    } catch (x) {
        var lastChildId = -1;
        error = 1;
    } finally {
        if( !error )var lastChildId = document.getElementById("main").lastChild.getAttribute("id").substring(9);
    }
    return String(lastChildId);
}