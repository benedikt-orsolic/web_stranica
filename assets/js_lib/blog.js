

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
    var lastChild = document.getElementById("main").lastChild.getAttribute("id");
    var lastChildId = -1;

    lastChildId = lastChild.substring(9);
    return lastChildId;
}