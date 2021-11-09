<?php
include_once('dbconnect.php');

//updates the item
if(isset($_POST['editItem'])) {
    $stmt = $conn->prepare("UPDATE Items SET Name = ?, Amount = ?, Placement = ?, Category = ?, Description = ?, Serialnumber = ? WHERE ID = ?");
    $stmt->bind_param("siiisii", $_POST['name'], $_POST['amount'], $_POST['placeId'], $_POST['categoryId'], $_POST['description'], $_POST['serialnumber'], $_POST['id']);
    $stmt->execute();
    header("location: page/".$_POST['previousPage']);
}