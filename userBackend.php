<?php
include_once('dbconnect.php');

//updates the user changes on 'My user'
if(isset($_POST['editMyUser'])) {
    
    if($_POST['psw1'] != "" && $_POST['psw1'] == $_POST['psw2']) {
        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, Password = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $_POST['name'], $_POST['uname'], $_POST['psw1'], $_POST['ID']);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $_POST['name'], $_POST['uname'], $_POST['ID']);
        $stmt->execute();
    }
    header("location: page/".$_POST['previousPage']);
}

//updates the user changes on 'Users'
if(isset($_POST['editUser'])) {
    //since checkbox return 'on' or 'off', I change it to 1 or 0 instead
    $admin = ($_POST['admin'] == "on" ? 1 : 0);

    if($_POST['psw1'] != "" && $_POST['psw1'] == $_POST['psw2']) {
        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, Password = ?, IsAdmin = ? WHERE ID = ?");
        $stmt->bind_param("sssii", $_POST['name'], $_POST['uname'], $_POST['psw1'], $admin, $_POST['ID']);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, IsAdmin = ? WHERE ID = ?");
        $stmt->bind_param("ssii", $_POST['name'], $_POST['uname'], $admin, $_POST['ID']);
        $stmt->execute();
    }
    header("location: page/".$_POST['previousPage']);
}