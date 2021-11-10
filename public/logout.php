<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['Admin']);
//Destroys session and directs user to login site
session_destroy();
header('location:index.php');
?>