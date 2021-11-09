<?php
include_once('../dbconnect.php');

//updates the user changes on 'My user'
if(isset($_POST['searchItem'])) {
    
    if($_POST['Search'] != "") {
        $stmt = $conn->prepare("SELECT Items.ID, Items.Name, Amount, Warehouse.ShelfNr, Warehouse.RowNr, Warehouse.PlacementNr, Category.Name AS Category, CreatedDate, ModifiedDate, Image, Description, Serialnumber 
        FROM Items 
        INNER JOIN Category ON Items.Category = Category.ID
        INNER JOIN Warehouse ON Items.Placement = Warehouse.ID
        WHERE (Items.Name, Warehouse.ShelfNr, Warehouse.RowNr, Warehouse.PlacementNr, Category.Name, Serialnumber) LIKE '%?%'");
        $stmt->bind_param("s", $_POST['Search']);
        $stmt->execute();
    }
    header("location: ../page/".$_POST['previousPage']);
}