<?php
    include_once('../dbconnect.php');
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
?>
<script>
    window.addEventListener('load', (event) => {
        var cat = document.getElementById("categorydrop");
        var pla = document.getElementById("placementdrop");
        var addCat = document.getElementById("Category");
        var addPla = document.getElementById("Placement");

        <?php foreach ($result2 as $category) { ?>
            var copt = document.createElement('option');
            copt.value = <?php echo $category['ID'] ?>;
            copt.innerHTML = '<?php echo $category['Name'] ?>';
            
            var copt2 = document.createElement('option');
            copt2.value = <?php echo $category['ID'] ?>;
            copt2.innerHTML = '<?php echo $category['Name'] ?>';
            cat.appendChild(copt);
            addCat.appendChild(copt2);
        <?php } ?>

        <?php foreach ($result3 as $place) { ?>
            var popt = document.createElement('option');
            popt.value = <?php echo $place['ID'] ?>;
            popt.innerHTML = '<?php echo "R: " . $place['RowNr'] . " S: " . $place['ShelfNr'] . " P: " . $place['PlacementNr']?>';

            var popt2 = document.createElement('option');
            popt2.value = <?php echo $place['ID'] ?>;
            popt2.innerHTML = '<?php echo "R: " . $place['RowNr'] . " S: " . $place['ShelfNr'] . " P: " . $place['PlacementNr']?>';
            pla.appendChild(popt);
            addPla.appendChild(popt2);
    <?php } ?>
    });

</script>
<html>
    <head>
        <link rel="stylesheet" href="../style/overview.css">
        <link rel="stylesheet" href="../style/modal.css">
        <script type="text/javascript" src="../components/popup.js"></script>
        <script type="text/javascript" src="../components/item.js"></script>
    </head> 
    <body>

    
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Add new item!</h1>
                <form action="../backend/insertItem.php" method="post">
                    <input type="text" placeholder="Name"  id="Name" name="Name" class="inputPop"></input>
                    <input type="text" placeholder="Amount" id="Amount" name="Amount" class="inputPop"></input>                    
                    <br>
                    <select type="text" placeholder="Placement(dropdown)" class="inputSel" id="Placement" name="Placement">
                    </select>
                    <select type="text" placeholder="Category (dropdown)" class="inputSel" id="Category" name="Category">
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

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="closeEdit">&times;</span>
                <h1>Edit item</h1>
                <form action="../backend/itemBackend.php" method="POST">
                    <input type="hidden" name="editItem" value="editItem"></input>
                    <input type="hidden" name="previousPage" value="overview.php"></input>
                    <input type="hidden" name="id" id="id"></input>
                    <input type="hidden" name="categoryId" id="categoryId"></input>
                    <input type="hidden" name="placeId" id="placeId"></input>
                    <input type="text" name="name" id="name" class="inputPop"></input>
                    <input type="text" name="amount" id="amount" class="inputPop"></input>
                    <select type="text" placeholder="Category (dropdown)" class="inputSel" id="categorydrop">
                    </select>
                    <select type="text" placeholder="Placement (dropdown)" class="inputSel" id="placementdrop">
                    </select>
                    <input type="text" name="description" id="description" class="inputPop"></input>
                    <input type="text" name="serialnumber" id="serialnumber" class="inputPop"></input>                   
                    <input type="submit" id="save" value="Save" class="saveBtn"></input>                    
                </form>
            </div>
        </div>

        <div class="overviewItem">
            <table id="myTable">
                <tr id="tableHeader">
                    <th>
                        <input id="Search" name="Search" placeholder="Search" onkeyup="searchTable()"></input>
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
                                <form action="../backend/regulateItems.php" method="POST">
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
                                <td> <?php echo "R: {$row["RowNr"]} S: {$row["ShelfNr"]} P: {$row["PlacementNr"]}";?></td>
                                <td> <?php echo $row["Category"] ?></td>
                                <td> <?php echo $row["CreatedDate"] ?></td>
                                <td> <?php echo $row["ModifiedDate"] ?></td>
                                <td> <?php echo $row["Description"] ?></td>
                                <td> <?php echo $row["Serialnumber"] ?></td>
                                <td>
                                    <button class="edit" id="addBtn<?php echo $row['ID']?>" onclick="editItem(<?php echo $row['ID']?>, '<?php echo $row['Name']?>', <?php echo $row['Amount']?>, <?php echo $row['ShelfNr']?>, <?php echo $row['RowNr']?>, <?php echo $row['PlacementNr']?>, '<?php echo $row['Category']?>', '<?php echo $row['Description']?>', <?php echo $row['Serialnumber']?>)">Edit</button>
                                </td>
                                <td>
                                    <form action="../backend/DeleteItem.php" method="post">
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
                ?>
            </table>
        </div>

    </body>
</html>