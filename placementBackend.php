<?php
include_once('dbconnect.php');

//updates the placement
if(isset($_POST['editPlacement'])) {
    $stmt = $conn->prepare("UPDATE Warehouse SET RowNr = ?, ShelfNr = ?, PlacementNr = ? WHERE ID = ?");
    $stmt->bind_param("iiii", $_POST['row'], $_POST['shelf'], $_POST['placement'], $_POST['ID']);
    $stmt->execute();
    header("location: page/".$_POST['previousPage']);
}

//adds placement to warehouse
if(isset($_POST['addPlacement'])) {
    $placements = "SELECT ID, RowNr, ShelfNr, PlacementNr FROM Warehouse;";
    $result = mysqli_query($conn, $placements);
    foreach ($result AS $placement) {
        if($placement['RowNr'] == $_POST['row'] && $placement['ShelfNr'] == $_POST['shelf'] && $placement['PlacementNr'] == $_POST['placement']) {
            header("location: page/".$_POST['previousPage']);
        }
    }
    if($_POST['row'] != "" && $_POST['shelf'] != "" && $_POST['placement'] != "") {
        $stmt = $conn->prepare("INSERT INTO Warehouse (RowNr, ShelfNr, PlacementNr) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $_POST['row'], $_POST['shelf'], $_POST['placement']);
        $stmt->execute();
    }
    header("location: page/".$_POST['previousPage']);
}

//delete the placement
if(isset($_POST['deletePlacement'])) {
    $stmt = $conn->prepare("DELETE FROM Warehouse WHERE ID = ?");
    $stmt->bind_param("i", $_POST['placementID']);
    $stmt->execute();
    header("location: page/".$_POST['previousPage']);
}
