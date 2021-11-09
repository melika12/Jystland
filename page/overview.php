<?php
    require_once('../dbconnect.php');
    require('menu.php');        
    
    $sql = "SELECT Items.ID, Items.Name, Amount, Warehouse.ShelfNr, Warehouse.RowNr, Warehouse.PlacementNr, Category.Name AS Category, CreatedDate, ModifiedDate, Image, Description, Serialnumber 
    FROM Items 
    INNER JOIN Category
    ON Items.Category = Category.ID
    INNER JOIN Warehouse
    ON Items.Placement = Warehouse.ID";
    $sql2 = "SELECT ID, Name FROM Category";
    $sql3 = "SELECT ID, RowNr, ShelfNr, PlacementNr FROM Warehouse";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    $line = "";
    
    $placement = "";
    session_start();
    if(isset($_SESSION['searchItem'])) {
        $result = $_SESSION['searchItem'];
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="../style/overview.css">
        <script type="text/javascript" src="../components/popup.js"></script>
    </head> 
    <body>

    
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Add new item!</h1>
                <form action="../components/insertItem.php" method="post">
                    <input type="text" placeholder="Name"  id="Name" name="Name" class="inputPop"></input>
                    <input type="text" placeholder="Amount" id="Amount" name="Amount" class="inputPop"></input>                    
                    <br>
                    <select type="text" placeholder="Placement(dropdown)" class="inputSel" id="Placement" name="Placement">
                        <?php 
                            if ($result2->num_rows > 0) {
                                // output data of each row
                                while($row2 = $result2->fetch_assoc()) {
                                    $line= "<option value=".$row2["ID"].">".$row2["Name"]."</option>";
                                    echo $line;
                                }
                                } else {
                                    echo "0 results";
                                }                        
                        ?>
                    </select>
                    <select type="text" placeholder="Category (dropdown)" class="inputSel" id="Category" name="Category">
                        <?php 
                            if ($result3->num_rows > 0) {
                                // output data of each row
                                while($row3 = $result3->fetch_assoc()) {
                                    $placement= "<option value=".$row3["ID"].">Row ".$row3["RowNr"]." Shelf ".$row3["ShelfNr"]." Placement ".$row3["PlacementNr"]."</option>";
                                    echo $placement;
                                }
                            } else {
                                echo "0 results"; 
                            }                        
                        ?>
                    </select>
                    <br>
                    <textarea type="text" placeholder="Description" class="inputPopDescription" id="Description" name="Description"></textarea>
                    <br>
                    <input type="text" placeholder="Serial number" class="inputPop" id="Serial" name="Serial"></input>
                    
                    <input type="submit" value="Save" class="saveBtn"></input>                    
                </form>
            </div>

        </div>
        <button class="newItem" id="addBtn" onclick="newItem()">New Item</button>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>

                    <!-- enten skal hele siden ændres i opsætning, ellers skal der laves en ny side til search funktionen - spørg Loke -->
                        <form action="../backend/itemBackend.php" method="POST">
                            <input type="hidden" name="previousPage" value="overview.php"></input>
                            <input id="Search" name="Search" placeholder="Search"></input>
                            <input type="submit" value="Search" class="saveBtn" style="background-color:grey"></input>      
                        </form>              
                    </th>
                    <th>Change amount</th>
                    <th>Img</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Placement</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Description</th>
                    <th>Serial number</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr id="<?php echo $row["ID"] ?>" >
                            <td></td>
                            <td>
                                <form action="../components/regulateItems.php" method="POST">
                                    <button style='display: inline;' name="action" value="Add">+</button>
                                    <button style='display: inline;' name="action" value="Remove">-</button>
                                    <input placeholder="<?php echo $row["Amount"] ?>" name="amountChanged" style='width: 4vw;'></input>
                                    <input type="hidden" name="ID" value="<?php echo $row["ID"] ?>"> </input>
                                    <input type="hidden" name="previousPage" value="overview.php"> </input>
                                </form>
                            </td>
                            <td> <?php echo $row["Image"] ?> </td>
                                <td> <?php echo $row["Name"] ?> </td>
                                <td> <?php echo $row["Amount"] ?> </td>
                                <td> <?php echo "S: {$row["ShelfNr"]} R: {$row["RowNr"]} P: {$row["PlacementNr"]}";?></td>
                                <td> <?php echo $row["Category"] ?></td>
                                <td> <?php echo $row["CreatedDate"] ?></td>
                                <td> <?php echo $row["ModifiedDate"] ?></td>
                                <td> <?php echo $row["Description"] ?></td>
                                <td> <?php echo $row["Serialnumber"] ?></td>
                                <td>
                                    <button> Edit <?php?> </button>
                                </td>
                                <td>
                                    <form action="../components/DeleteItem.php" method="post">
                                        <input type='text' name="itemID" value="<?php echo $row["ID"] ?>" style="visibility: hidden;width:0.vw"></input>
                                        <input type="submit" style="color: red;background-color: black;border: none;" value="X"></input>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        } else {
                        echo "0 results";
                        }
                        $conn->close();
                //echo $line; ?>
            </table>
        </div>

    </body>
</html>