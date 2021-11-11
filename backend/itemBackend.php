<?php
include_once('../dbconnect.php');

//updates the item
if(isset($_POST['editItem'])) {
    //checking if the serialnumber already exists
    $serial = $_POST['serialnumber'];
    $place = $_POST['placeId'];
    $serials = "SELECT Serialnumber, Placement FROM Items WHERE Serialnumber = $serial OR Placement = '$place';";
    $result = mysqli_query($conn, $serials);

    if($result->num_rows > 0) {
        header("location: ../public/".$_POST['previousPage']);
    } else {        
        $stmt = $conn->prepare("UPDATE Items SET Name = ?, Amount = ?, Placement = ?, Category = ?, Description = ?, Serialnumber = ? WHERE ID = ?");
        $stmt->bind_param("siiisii", $_POST['name'], $_POST['amount'], $_POST['placeId'], $_POST['categoryId'], $_POST['description'], $_POST['serialnumber'], $_POST['id']);
        $stmt->execute();
        
        header("location: ../public/".$_POST['previousPage']);
    }
}