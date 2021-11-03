<?php
    require_once('../dbconnect.php');
    require('menu.php');
        
    
    $sql = "SELECT ID, Name, Amount, Placement, Category, CreatedDate, ModifiedDate, Image, Description, Serialnumber FROM Items";
    $result = $conn->query($sql);

    $line = "";
?>
<html>
    <head>
        <link rel="stylesheet" href="../style/overview.css">
    </head> 
    <body>
        <button class="newItem">New Item</button>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>
                        <input placeholder="Search"></input>
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
                </tr>
                <?php 
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr id="<?php echo $row["ID"] ?>" >
                            <td></td>
                            <td>
                                <button style='display: inline;'>+</button>
                                <button style='display: inline;'>-</button>
                                <input placeholder="<?php echo $row["Amount"] ?>" style='width: 4vw;'></input>
                            </td>
                            <td> <?php echo $row["Image"] ?> </td>
                                <td> <?php echo $row["Name"] ?> </td>
                                <td> <?php echo $row["Amount"] ?> </td>
                                <td> <?php echo $row["Placement"] ?></td>
                                <td> <?php echo $row["Category"] ?></td>
                                <td> <?php echo $row["CreatedDate"] ?></td>
                                <td> <?php echo $row["ModifiedDate"] ?></td>
                                <td> <?php echo $row["Description"] ?></td>
                                <td> <?php echo $row["Serialnumber"] ?></td>
                            </tr>
                            </td>
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