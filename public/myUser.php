<?php
    require('menu.php');
    include_once('../dbconnect.php');
    
    if(isset($_SESSION["userID"])) {
        $UserID = $_SESSION["userID"];
        $sql = "SELECT ID, Name, Username FROM Users WHERE ID = $UserID";
        
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/myUser.css">
        <link rel="stylesheet" href="../style/modal.css">
        <script type="text/javascript" src="../components/myUser.js"></script>
    </head> 
    <body>  
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Edit your user</h1>
                <form action="../backend/userBackend.php" method="POST">
                    <input type="hidden" name="editMyUser" value="editMyUser"></input>
                    <input type="hidden" name="previousPage" value="myUser.php"></input>
                    <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>"></input>
                    <input type="text" name="name" value="<?php echo $row['Name'] ?>" class="inputPop"></input>
                    <input type="text" name="uname" value="<?php echo $row['Username'] ?>" class="inputPop"></input>                    
                    <br>
                    <input type="password" name="psw1" placeholder="Password" class="inputPop"></input>
                    <input type="password" name="psw2" placeholder="Repeat password" class="inputPop"></input>
                    <br>                    
                    <input type="submit" id="save" value="Save" class="saveBtn"></input>                    
                </form>
            </div>
        </div>

        <!-- The overview -->
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Edit user</th>
                </tr>
                <tr>
                <?php 
                if ($result->num_rows > 0) {
                    // output data of each row
                    ?>
                    <td> <?php echo $row['Name'] ?></td>                    
                    <td> <?php echo $row['Username'] ?></td>                    
                <?php } ?>
                    <td><button class="newItem" id="addBtn" onclick="newItem()">Edit</button></td>
                </tr>
            </table>
        </div>
    </body>
</html>