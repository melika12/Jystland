<?php
    require_once('../dbconnect.php');
    require('menu.php');

    $sql = "SELECT Items.ID, Items.Name, Amount, Warehouse.ShelfNr, Warehouse.RowNr, Warehouse.PlacementNr, Category.Name AS Category, CreatedDate, ModifiedDate, Image, Description, Serialnumber 
    FROM Items
    INNER JOIN Category
    ON Items.Category = Category.ID 
    INNER JOIN Warehouse
    ON Items.Placement = Warehouse.ID WHERE Amount < 50";
    $result = $conn->query($sql);
?>

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