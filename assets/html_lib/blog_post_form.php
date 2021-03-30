<button id="createNewPost">
    Create a new post
</button>


<section id="blogEditor">
    <label>Blog post title: </label><br>
    <input id='blogPostTitle' type="text" name='title'><br>
    <label>Blog post body: </label><br>
    <textarea id='blogPostBody' name="body" rows="4" cols="50">Enter text here... </textarea>

    <input onclick="updatePost()" id="blogPostSubmitButton" name="submit" type="submit" value='Post' style="float: right;"></button>

    <input onchange="uploadImage()" id="blogImageFileUpload" type="file" name="imageUpload"/>
</section>
<br>


<!--assets/php_lib/upload_blog_post.php-->