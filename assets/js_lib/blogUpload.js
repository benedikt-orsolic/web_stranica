document.getElementById('blogPostSubmitButton').addEventListener('click', () => {
            console.log("hello")
            uploadAndRetrieveConverted()
})


function uploadAndRetrieveConverted() {
    let title = document.getElementById('blogPostTitle').value
    let text = document.getElementById('blogPostBody').value
    uploadPost(title, text);
}







function uploadPost( title, text ) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("blogPosts").innerHTML = this.responseText + document.getElementById("main").innerHTML;
        }
    };

    xhttp.open('POST', 'assets/php_lib/upload_blog_post.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&upid=-1&limit=1&title=' + String( title ) + '&body=' + String( text )  );
}