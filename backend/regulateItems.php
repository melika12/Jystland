<?php
session_start();
include_once('../dbconnect.php');

$amountChanged = $_POST["amountChanged"];
$action = $_POST["action"];
$ID = $_POST["ID"];
$UserID = $_SESSION["userID"];

if($action == "Add"){
    $stmt = $conn->prepare("UPDATE Items SET Amount = amount + ? where Id = ?");
    $stmt->bind_param("ii", $amountChanged, $ID);
    $stmt->execute();
} elseif($action == "Remove"){
    $stmt = $conn->prepare("UPDATE Items SET Amount = amount - ? where Id = ?");
    $stmt->bind_param("ii", $amountChanged, $ID);
    $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO Logs (AmountChanged, Action, ItemId, UserId)
VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $amountChanged, $action, $ID, $UserID);
$stmt->execute();

$stmt->close();
header("location: ../public/".$_POST['previousPage']);
?>