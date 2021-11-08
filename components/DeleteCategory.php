<?php
    require_once('../dbconnect.php');

    $id =  $_REQUEST['catID'];

    $url = "../page/category.php";
    
    $sql = "DELETE FROM Category WHERE id=$id";
       

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