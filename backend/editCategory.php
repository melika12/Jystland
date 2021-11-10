<?php
  require_once('../dbconnect.php');

  $id = $_POST['id'];
  $name = $_POST['name'];
  $url = "../public/category.php";

  //checking if the category already exists
  $category = "SELECT Name FROM Category WHERE Name = '$name';";
  $result = mysqli_query($conn, $category);

  if($result) {
    header('Location: '.$url);
  } else {
    $sql = "UPDATE Category SET Name='$name' WHERE id=$id";

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