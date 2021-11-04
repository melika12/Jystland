<?php
    require_once('../dbconnect.php');

    $url = "../page/overview.php";

    $stmt = $conn->prepare("INSERT INTO Items (Name, Amount, Placement, Category, Description, Serialnumber) 
    VALUES (?,?,?,?,?,?)");
    $stmt->bind_param('siiisi', $_POST['Name'], $_POST['Amount'], $_POST['Placement'], $_POST['Category'], $_POST['Description'], $_POST['Serial']);
    $stmt->execute();
    header('Location: '.$url);
    die();
 /*
    if(mysqli_query($conn, $sql)){

        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();

    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }
        
    // Close connection
    mysqli_close($conn);*/
?>