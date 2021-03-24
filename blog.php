<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'assets/html_lib/global_head_elements.html'; ?>
    <link rel="stylesheet" href="assets/css_lib/blog.css">
</head>

<body>

    <?php include 'assets/html_lib/nav.php'; ?>

    <main id='main'>
        
        <h1>My blog</h1>
        <?php if( isset($_SESSION['uuid']) ) include 'assets/html_lib/blog_post_form.php'; ?>
        <section id="blogPosts"></section>
    </main>
</body> 

<script src='assets/js_lib/blog.js' type="text/javascript"></script>
<script src='assets/js_lib/blogUpload.js' type="text/javascript"></script>
</html>