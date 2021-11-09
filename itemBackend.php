<?php
include_once('dbconnect.php');

$sql = "UPDATE Items SET Name=$name, Amount=$amount, Placement=$placement, Category=$category, Description=$description, Serialnumber=$serialnumber WHERE id=$id";

if(isset($_POST['editItem'])) {


    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    header("location: page/".$_POST['previousPage']);
}
?>
