document.getElementById('blogPostSubmitButton').addEventListener('click', () => {
            updatePost();
});

document.getElementById('blogPosts').addEventListener('click', (event) => {

    if(event.target.nodeName === 'BUTTON') {
        openPostUpdate(event.target.parentElement);
    }
});

function updatePost() {

    const formData = new FormData();
    formData.append('submit', 1);
    formData.append('upid', document.getElementById('blogPostUpid').value)
    formData.append('title', document.getElementById('blogPostTitle').value);
    formData.append('body', document.getElementById('blogPostBody').value);


    const xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("blogPosts").innerHTML = this.responseText + document.getElementById("blogPosts").innerHTML;
        }
    };

    xhttp.open('POST', 'assets/php_lib/blogUpdatePost.php', true);
    xhttp.send( formData );
}

function openPostUpdate(postWraper) {
    console.log(postWraper.getAttribute("id").substring(9));
}