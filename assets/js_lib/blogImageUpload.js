const imgFile = document.getElementById("blogImageFileUpload")

imgFile.addEventListener("change", () => {
    console.log('hel')
    uploadImage()
})


function uploadImage() {
    
    const xhttp = new XMLHttpRequest();
    const formData = new FormData();

    console.log(imgFile.files)

    formData.append("imgUpload", imgFile.files)

    xhttp.open('POST', 'assets/php_lib/blogUploadImage.php', true);
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send( formData );
}