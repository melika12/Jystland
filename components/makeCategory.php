<?php
    require_once('../dbconnect.php');
    $name = $_POST["Name"];
    $url = "../public/category.php";

    $sql = "INSERT INTO Category (Name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

   header('Location: '.$url);

    $conn->close();


?>