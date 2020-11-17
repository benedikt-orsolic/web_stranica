<nav class="navBar">
    <ul class="flex-nav">
        <li>
            <a href="index.php" class="navLink">
                <i class="navIcon fas fa-home fa-sm"></i>
                <span class="navText">Home</span>
            </a>
        </li>
        <li>
            <a href="my_projects.php" class="navLink">
                <i class="navIcon fas fa-tools fa-sm"></i>
                <span class="navText">My projects</span>
            </a>
        </li>
        <li> 
            <a href="blog.php" class="navLink">
                <i class="navIcon fas fa-blog fa-sm"></i>
                <span class="navText">Blog</span>
            </a>
        </li>
        <li>  
            <?php 
                session_start();
                if(isset($_SESSION['uuid'])) {
                    echo('
                    <a href="assets/php_lib/logout.php"  class="navLink">
                        <i class="navIcon fas fa-sign-out-alt fa-sm"></i> 
                        <span class="navText">Log out '.$_SESSION['userName'].'</span>
                    </a>
                    ');
                } else {
                    echo('
                    <a href="assets/php_lib/logout.php"  class="navLink">
                        <i class="navIcon fas fa-sign-in-alt fa-sm"></i> 
                        <span class="navText">Log in</span>
                    </a>
                    ');
                }
            ?>
        </li>
    </ul>
</nav>