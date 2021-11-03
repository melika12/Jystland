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
        <script type="text/javascript" src="../components/popup.js"></script>
    </head> 
    <body>

    
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Add new item!</h1>
                <form>
                    <input type="text" placeholder="Name" class="inputPop"></input>
                    <input type="text" placeholder="Amount" class="inputPop"></input>                    
                    <br>
                    <select type="text" placeholder="Placement(dropdown)" class="inputSel">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                    </select>
                    <select type="text" placeholder="Category (dropdown)" class="inputSel">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                    </select>
                    <br>
                    <textarea type="text" placeholder="Description" class="inputPopDescription"></textarea>
                    <br>
                    <input type="text" placeholder="Serial number" class="inputPop"></input>
                    
                    <input type="submit" value="Save" class="saveBtn"></input>                    
                </form>
            </div>

        </div>
        <button class="newItem" id="addBtn" onclick="newItem()">New Item</button>
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