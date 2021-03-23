<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'assets/html_lib/global_head_elements.html' ?>
    <link rel="stylesheet" href="assets/css_lib/my_projects.css">
</head>

<body>
    <?php include 'assets/html_lib/nav.php' ?>
    
<main>
<h1>Here will be some of my projects</h1>

<nav class="projectNav">
    <ul>
        <li>Projcet</li>
        <li>Project</li>
        <li>Project</li>
    </ul>   

</nav>
<div class="wraper"></div>
    <section id="electronics">
        <h2>Electronics</h2>
        <article>
            <h3>Soldering iron station</h3>

            <img height="500" width="500" alt="project img">
            <ul>
                <li>File 1</li>
                <li>File 2</li>
                <li>File 3</li>
            </ul>

        </article>
        <article>
            <h3>LED dimmer</h3>

            <img height="500" width="500" alt="project img">
            <ul>
                <li>File 1</li>
                <li>File 2</li>
                <li>File 3</li>
            </ul>

        </article>
    </section>
    
    <section id="programing">
        <h2>Programing projects</h2>
    <article>
            <h3>Web page</h3>

            <img height="500" width="500" alt="project img">
            <ul>
                <li>File 1</li>
                <li>File 2</li>
                <li>File 3</li>
            </ul>

        </article>
    </section>
</main>












</body>

</html>