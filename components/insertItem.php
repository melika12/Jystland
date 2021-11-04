<?php
    require_once('../dbconnect.php');

    $Name =  $_REQUEST['Name'];
    $Amount = $_REQUEST['Amount'];
    $Placement =  $_REQUEST['Placement'];
    $Category = $_REQUEST['Category'];
    $Description = $_REQUEST['Description'];
    $Serial = $_REQUEST['Serial'];

    $url = "../page/overview.php";
    /*function redirect($url){
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    };*/
    
    $sql = "INSERT INTO Items (Name, Amount, Placement, Category, Description, Serialnumber) VALUES ('$Name','$Amount','$Placement','$Category','$Description','$Serial')";
       
    

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
    mysqli_close($conn);
?>