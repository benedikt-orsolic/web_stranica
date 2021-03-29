const imgFile = document.getElementById("blogImageFileUpload")

imgFile.addEventListener("change", () => {
    uploadImage()
})


function uploadImage() {
    
    const xhttp = new XMLHttpRequest();
    const formData = new FormData();

    console.log( imgFile.files )

    formData.append("imgUpload", imgFile.files[0])

    xhttp.open('POST', 'assets/php_lib/upload_blog_post_image.php', true);
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send( formData );
}