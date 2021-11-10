<?php
//Destroys session and directs user to login site
session_destroy();
unset($_SESSION['username']);
header('location:index.php');
?>