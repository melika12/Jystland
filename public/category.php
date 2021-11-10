<?php
    require_once('../dbconnect.php');
    require('menu.php');
    $line="";

    $sql = "SELECT ID, Name FROM Category";
    
?>
    <head>
        <link rel="stylesheet" href="../style/category.css">
        <script type="text/javascript" src="../components/category.js"></script>
    </head> 
    <body>  
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Add new Category!</h1>
            <form action="../components/makeCategory.php" method="post">
                <input type="text" placeholder="Name"  id="Name" name="Name" class="inputPop"></input>            
                <input type="submit" value="Save" class="saveBtn"></input>                    
            </form>
        </div>
    </div>
    <div id="edit" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Edit Category!</h1>
            <form action="../components/editCategory.php" method="post">
                <input type="text" id="name" name="name" class="inputPop"></input> 
                <input type="submit" value="Save" class="saveBtn"></input>  <br>
                <input type="text"  id="id" name="id" style="visibility: hidden;" ></input>                
                <input type="hidden" name="editUser" value="editUser"></input>                            
            </form>
        </div>
    </div>
    <button class="newCat" id="addBtn"  onclick="newCategory()">New Category</button>    
        <div class="overviewItem">
            <table>
                <?php 
                    $result = $conn->query($sql);
                    
                    foreach ($result AS $sql) {
                        echo '<tr>';
                        echo '<td>' . utf8_encode($sql['Name']) . '</td>';                         
                        echo "<td><button class=\"newItem\" id=\"editBtn".$sql['ID']."\" onclick=\"editCategory(".$sql['ID'].",'".$sql['Name']."')\">Edit</button></td>";
                        ?>
                        <td>
                            <form action="../components/DeleteCategory.php" method="post">
                                <input type='text' name="catID" value="<?php echo $sql["ID"] ?>" style="visibility: hidden;width:0.vw"></input>
                                <input type="submit" style="color: red;background-color: black;border: none;" value="X"></input>
                            </form>
                        </td>
                        <?php
                        echo '</tr>';      
                    } 




/*

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $line="
                        <tr>
                            <td>" . $row["Name"]. "</td>
                            <td style=' visibility: hidden;'>" . $row["ID"]. "</td>
                            <td><button id='editBtn' onclick='editCategory()'>Edit</button></td>
                            <td><button>Delete</button></td>
                        </tr>";
                        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                        echo $line;
                    }
                    } else {
                    echo "0 results";
                    }
                    $conn->close();*/?>
            </table>
        </div>

    </body>