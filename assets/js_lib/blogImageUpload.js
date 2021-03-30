/* This is not working, have to call from html onchange=""

imgFile.addEventListener("change", () => {
    console.log('hel')
    uploadImage()
})*/


function uploadImage() {

    const xhttp = new XMLHttpRequest();
    const formData = new FormData();
    
    formData.append("imgUpload", document.getElementById('blogImageFileUpload').files[0]);
    
    formData.append('upid', 
                    document.getElementById('blogPostUpid').getAttribute("value"));

    console.log(imgFile.files)

    formData.append("imgUpload", imgFile.files)

    xhttp.open('POST', 'assets/php_lib/blogUploadImage.php', true);
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send( formData );
}