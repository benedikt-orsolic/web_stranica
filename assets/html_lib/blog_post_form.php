<form action="assets/php_lib/upload_blog_post.php" method="post">
    <label>Blog post title: </label><br>
    <input id='blogPostTitle' type="text" name='title'><br>
    <label>Blog post body: </label><br>
    <textarea id='blogPostBody' name="body" rows="4" cols="50">Enter text here... </textarea>


    <div style='display: inline-block'>
        <label>Add a nice image to represent your post: </label><br>
        <input type='file' name='postImage'>
    </div> 
    <input name="submit" type="submit" value='Post' style="float: right;"></button>


</form>
<br>