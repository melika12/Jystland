<?php
    require('menu.php');
    include_once('../dbconnect.php');

    $users = "SELECT ID, Name, Username, IsAdmin FROM Users;";
    $result = mysqli_query($conn, $users);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/user.css">
        <link rel="stylesheet" href="../style/modal.css">
        <script type="text/javascript" src="../components/user.js"></script>
    </head> 
    <body>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Edit your user</h1>
                <form action="../userBackend.php" method="POST">
                    <input type="hidden" name="editUser" value="editUser"></input>
                    <input type="hidden" name="previousPage" value="user.php"></input>
                    <input type="hidden" name="ID" id="ID"></input>
                    <input type="text" name="name" id="name" class="inputPop"></input>
                    <input type="text" name="uname" id="uname" class="inputPop"></input>                    
                    <input type="checkbox" id="admin" name="admin" >
                    <label for="admin"> Is admin</label>
                    <br>
                    <input type="text" name="psw1" placeholder="Password" class="inputPop"></input>
                    <input type="text" name="psw2" placeholder="Repeat password" class="inputPop"></input>
                    <br>                    
                    <input type="submit" id="save" value="Save" class="saveBtn"></input>                    
                </form>
            </div>
        </div>

        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>IsAdmin</th>
                    <th>Edit user</th>
                </tr>
                <?php 
                    foreach ($result AS $user) {
                        echo '<tr>';
                        echo '<td>' . utf8_encode($user['Name']) . '</td>';                    
                        echo '<td>' . utf8_encode($user['Username']) . '</td>';                    
                        echo '<td>',($user['IsAdmin'] ? 'Yes</td>' : 'No</td>');                   
                        echo "<td><button class=\"newItem\" id=\"addBtn".$user['ID']."\" onclick=\"newItem(".$user['ID'].",'".$user['Name']."','".$user['Username']."',".$user['IsAdmin'].")\">Edit</button></td>";
                        echo '</tr>';      
                    } 
                ?>
            </table>
        </div>
    </body>
</html>