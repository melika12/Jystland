<?php
    require('menu.php');
    include_once('../dbconnect.php');

    $placements = "SELECT ID, RowNr, ShelfNr, PlacementNr FROM Warehouse;";
    $result = mysqli_query($conn, $placements);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/placement.css">
        <link rel="stylesheet" href="../style/modal.css">
        <script type="text/javascript" src="../components/placement.js"></script>
    </head> 
    <body>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Edit placement</h1>
                <form action="../backend/placementBackend.php" method="POST">
                    <input type="hidden" name="editPlacement" value="editPlacement"></input>
                    <input type="hidden" name="previousPage" value="placement.php"></input>
                    <input type="hidden" name="ID" id="ID"></input>
                    <input type="number" min="1" name="row" id="row" class="inputPop"></input>
                    <input type="number" min="1" name="shelf" id="shelf" class="inputPop"></input>                    
                    <input type="number" min="1" name="placement" id="placement" class="inputPop"></input>                    
                    <input type="submit" id="save" value="Save" class="saveBtn"></input>                    
                </form>
            </div>
        </div>
        <div id="newModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="closeNewPlacement">&times;</span>
                <h1>Add new placement</h1>
                <form action="../backend/placementBackend.php" method="POST">
                    <input type="hidden" name="addPlacement" value="addPlacement"></input>
                    <input type="hidden" name="previousPage" value="placement.php"></input>
                    <input type="hidden" name="ID" id="ID"></input>
                    <input type="number" min="1" name="row" id="row" class="inputPop"></input>
                    <input type="number" min="1" name="shelf" id="shelf" class="inputPop"></input>                    
                    <input type="number" min="1" name="placement" id="placement" class="inputPop"></input>                    
                    <input type="submit" id="save" value="Save" class="saveBtn"></input>                    
                </form>
            </div>
        </div>
        <button class="newPlacement" id="addPlacement" onclick="add()">New placement</button>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Row number</th>
                    <th>Shelf number</th>
                    <th>Placement number</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($result AS $placement) { ?>
                <tr>
                    <td><?php echo $placement['RowNr'] ?></td>                    
                    <td><?php echo $placement['ShelfNr'] ?></td>                    
                    <td><?php echo $placement['PlacementNr'] ?></td>                   
                    <td><button class="newItem" id="addBtn<?php echo $placement['ID']?>" onclick="edit(<?php echo $placement['ID']?>, <?php echo $placement['RowNr']?>, <?php echo $placement['ShelfNr']?>, <?php echo $placement['PlacementNr']?>)">Edit</button></td>
                    <td>
                        <form action="../backend/placementBackend.php" method="POST">
                            <input type="hidden" name="deletePlacement" value="deletePlacement"></input>
                            <input type="hidden" name="previousPage" value="placement.php"></input>
                            <input type='text' name="placementID" value="<?php echo $placement["ID"] ?>" style="visibility: hidden;width:0.vw"></input>
                            <input type="submit" style="color: red;background-color: black;border: none;" value="X"></input>
                        </form>
                    </td>
                </tr>      
                <?php } ?>
            </table>
        </div>
    </body>
</html>