<?php
include_once('../dbconnect.php');

//updates the user changes on 'My user'
if(isset($_POST['searchItem'])) {
    
    if($_POST['Search'] != "") {
        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, Password = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $_POST['name'], $_POST['uname'], $_POST['psw1'], $_POST['ID']);
        $stmt->execute();
    }
    header("location: ../page/".$_POST['previousPage']);
}