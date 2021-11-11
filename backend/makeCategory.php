<?php
require_once('../dbconnect.php');
$name = $_POST["Name"];
$url = "../public/category.php";

//checking if the category already exists
$category = "SELECT Name FROM Category WHERE Name = '$name';";
$result = mysqli_query($conn, $category);

if($result->num_rows > 0) {
    header('Location: ' . $url);
} else {
    $sql = "INSERT INTO Category (Name) VALUES ('$name')";

    if(mysqli_query($conn, $sql)){
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    } else{
        echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
    }
        
    // Close connection
    mysqli_close($conn);
}