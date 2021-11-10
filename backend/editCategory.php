<?php
    require_once('../dbconnect.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $url = "../public/category.php";

    $sql = "UPDATE Category SET Name='$name' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error updating record: " . $conn->error;
    }
    
    if(mysqli_query($conn, $sql)){

        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();

    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }
    $conn->close();
    
?>