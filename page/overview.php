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
                            $line = "
                            <tr id=".$row["ID"].">
                                <td></td>
                                <td>
                                    <button style='display: inline;'>+</button>
                                    <button style='display: inline;'>-</button>
                                    <input placeholder=". $row["Amount"]." style='width: 4vw;'></input>
                                    
                                </td>
                                <td>" . $row["Image"]. "</td>
                                <td>" . $row["Name"]. "</td>
                                <td>". $row["Amount"]."</td>
                                <td>". $row["Placement"]."</td>
                                <td>". $row["Category"]."</td>
                                <td>". $row["CreatedDate"]."</td>
                                <td>". $row["ModifiedDate"]."</td>
                                <td>". $row["Description"]."</td>
                                <td>". $row["Serialnumber"]."</td>
                            </tr>";
                            echo $line;
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