/* This is not working, have to call from html onchange=""

var img = document.getElementById('blogImageFileUpload');

document.getElementById('blogImageFileUpload').addEventListener("change", () => {
    uploadImage()
})*/


function uploadImage() {

    const xhttp = new XMLHttpRequest();
    const formData = new FormData();
    
    formData.append("imgUpload", document.getElementById('blogImageFileUpload').files[0]);
    
    formData.append('upid', 
                    document.getElementById('blogPostUpid').getAttribute("value"));

    xhttp.open('POST', 'assets/php_lib/blogUploadPostImage.php', true);
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send( formData );
}