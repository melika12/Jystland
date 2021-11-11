<?php
session_start();
include_once('../dbconnect.php');

//updates the user changes on 'My user'
if(isset($_POST['editMyUser'])) {
    //checking if the username already exists
    $user = $_POST['uname'];
    $userID = $_SESSION['userID'];

    $users = "SELECT Username FROM Users WHERE Username = '$user' AND ID != $userID;";
    $result = mysqli_query($conn, $users);

    if($result->num_rows > 0) {
        header("location: ../public/".$_POST['previousPage']);
    } else {  
        if($_POST['psw1'] != "" && $_POST['psw1'] == $_POST['psw2']) {
            $password = md5($_POST['psw1']);//encrypt the password before saving in the database

            $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, Password = ? WHERE ID = ?");
            $stmt->bind_param("sssi", $_POST['name'], $_POST['uname'], $password, $_POST['ID']);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ? WHERE ID = ?");
            $stmt->bind_param("ssi", $_POST['name'], $_POST['uname'], $_POST['ID']);
            $stmt->execute();
        }
        header("location: ../public/".$_POST['previousPage']);
    }
}

//updates the user changes on 'Users'
if(isset($_POST['editUser'])) {
    //since checkbox return 'on' or 'off', I change it to 1 or 0 instead
    $admin;
    if(!isset($_POST['admin'])) {
        $admin = 0;
    } else {
        $admin = ($_POST['admin'] == "on" ? 1 : 0);
    }

    //checking if the username already exists
    $user = $_POST['uname'];
    $userID = $_POST['ID'];

    $users = "SELECT Username FROM Users WHERE Username = '$user' AND ID != $userID;";
    $result = mysqli_query($conn, $users);

    if($result->num_rows > 0) {
        header("location: ../public/".$_POST['previousPage']);
    } else {
        if($_POST['psw1'] != "" && $_POST['psw1'] == $_POST['psw2']) {
            $password = md5($_POST['psw1']);//encrypt the password before saving in the database

            $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, Password = ?, IsAdmin = ? WHERE ID = ?");
            $stmt->bind_param("sssii", $_POST['name'], $_POST['uname'], $password, $admin, $_POST['ID']);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("UPDATE Users SET Name = ?, Username = ?, IsAdmin = ? WHERE ID = ?");
            $stmt->bind_param("ssii", $_POST['name'], $_POST['uname'], $admin, $_POST['ID']);
            $stmt->execute();
        }
        header("location: ../public/".$_POST['previousPage']);
    }
}