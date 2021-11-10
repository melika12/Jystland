<?php
    require_once('../dbconnect.php');

    $url = "../public/overview.php";

    $stmt = $conn->prepare("INSERT INTO Items (Name, Amount, Placement, Category, Description, Serialnumber) 
    VALUES (?,?,?,?,?,?)");
    $stmt->bind_param('siiisi', $_POST['Name'], $_POST['Amount'], $_POST['Placement'], $_POST['Category'], $_POST['Description'], $_POST['Serial']);
    $stmt->execute();
    header('Location: '.$url);
    die();
?>