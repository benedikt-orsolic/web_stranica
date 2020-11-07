<!DOCTYPE html>
<html>
<head>
    <title>Galery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    
    <nav>
        <a onclick="togleMenu()" id="navTogle" class="navLink">Nav</a>
        <a class="navLink"  href="index.php">Home</a>
        <a class="navLink" href="my_projects.php">My projects</a>
        <a class="navLink" href="login.php">Log in page</a>
    </nav>
<body>

<script>
var show = 1;


function togleMenu() {
    
    var navElements =  document.getElementsByClassName('navLink');
    var len = navElements.length;
    var i;

    if ( show ) {
        for( i=1; i < len; i++ ) {
            navElements[i].style.display = 'none';
        }
        show = 0;
    } else {
        for( i=1; i < len; i++ ) {
            navElements[i].style.display = 'block';
        }
        show = 1;
    }
}
</script>

</html>