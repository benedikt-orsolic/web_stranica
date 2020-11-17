<?php
session_start();
unset( $_SESSION['uuid'] );
session_unset();
session_destroy();
header('location: ../../login.php');
