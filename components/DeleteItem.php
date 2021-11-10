<?php
    require_once('../dbconnect.php');

    $id =  $_REQUEST['itemID'];

    $url = "../public/overview.php";
    
    $sql = "DELETE FROM Items WHERE id=$id";
       

    if(mysqli_query($conn, $sql)){

        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();

    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }
        
    // Close connection
    mysqli_close($conn);
?>