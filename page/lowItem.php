<?php
    require_once('../dbconnect.php');
    require('menu.php');

    $sql = "SELECT Items.ID, Items.Name, Amount, Warehouse.ShelfNr, Warehouse.RowNr, Warehouse.PlacementNr, Category.Name AS Category, CreatedDate, ModifiedDate, Image, Description, Serialnumber 
    FROM Items
    INNER JOIN Category
    ON Items.Category = Category.ID 
    INNER JOIN Warehouse
    ON Items.Placement = Warehouse.ID WHERE Amount < 50";
    $sql2 = "SELECT ID, Name FROM Category";
    $sql3 = "SELECT ID, RowNr, ShelfNr, PlacementNr FROM Warehouse";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
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
            popt.innerHTML = '<?php echo " R: " . $place['RowNr'] . " S: " . $place['ShelfNr'] . " P: " . $place['PlacementNr']?>';

            var popt2 = document.createElement('option');
            popt2.value = <?php echo $place['ID'] ?>;
            popt2.innerHTML = '<?php echo " R: " . $place['RowNr'] . " S: " . $place['ShelfNr'] . " P: " . $place['PlacementNr']?>';
            pla.appendChild(popt);
            addPla.appendChild(popt2);
    <?php } ?>
    });

</script>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/lowItem.css">
    </head> 
    <body>
        <h1 class="headline">please note that these item will be sold out soon!</h1>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Placement</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Description</th>
                    <th>Serial number</th>
                </tr>
                <?php 
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr id="<?php echo $row["ID"] ?>" >
                                <td class="lowAmount"> <?php echo $row["Name"] ?> </td>
                                <td class="lowAmount"> <?php echo $row["Amount"] ?> </td>
                                <td> <?php echo "R: {$row["RowNr"]} S: {$row["ShelfNr"]} P: {$row["PlacementNr"]}";?></td>
                                <td> <?php echo $row["Category"] ?></td>
                                <td> <?php echo $row["CreatedDate"] ?></td>
                                <td> <?php echo $row["ModifiedDate"] ?></td>
                                <td> <?php echo $row["Description"] ?></td>
                                <td> <?php echo $row["Serialnumber"] ?></td>
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