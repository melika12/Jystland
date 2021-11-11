<?php
    require_once('../dbconnect.php');

    $url = "../public/overview.php";

    //checking if the serialnumber already exists
    $serial = $_POST['Serial'];
    $place = $_POST['Placement'];
    $serials = "SELECT Serialnumber, Placement FROM Items WHERE Serialnumber = $serial OR Placement = '$place';";
    $result = mysqli_query($conn, $serials);

    if($result->num_rows > 0) {
        header('Location: '.$url);
    } else {
        $stmt = $conn->prepare("INSERT INTO Items (Name, Amount, Placement, Category, Description, Serialnumber) 
        VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('siiisi', $_POST['Name'], $_POST['Amount'], $_POST['Placement'], $_POST['Category'], $_POST['Description'], $_POST['Serial']);
        $stmt->execute();
        header('Location: '.$url);
        die();
    }
?>