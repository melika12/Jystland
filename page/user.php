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
        <script type="text/javascript" src="../components/newUser.js"></script>
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
        <div id="newUserModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="closeNewUser">&times;</span>
                <h1>Add new User!</h1>
                <form action="../components/newUser.php" method="post">
                    <input type="text" placeholder="Name" id="name" name="name" class="inputPop"></input>
                    <input type="text" placeholder="User name" id="username" name="username" class="inputPop"></input><br>
                    <input type="password" placeholder="Password" id="password_1" name="password_1" class="inputPop"></input>
                    <select class="inputSel" id="admin" name="admin">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select><br>
                    <input type="submit" value="Save" class="saveBtn" id="reg_user" name="reg_user"></input>                    
                </form>
            </div>
        </div>
        <button class="newUser" id="addUser" onclick="newUser()">New user</button>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>IsAdmin</th>
                    <th>Edit user</th>
                    <th>Delete user</th>
                </tr>
                <?php 
                    foreach ($result AS $user) {
                        echo '<tr>';
                        echo '<td>' . utf8_encode($user['Name']) . '</td>';                    
                        echo '<td>' . utf8_encode($user['Username']) . '</td>';                    
                        echo '<td>',($user['IsAdmin'] ? 'Yes</td>' : 'No</td>');                   
                        echo "<td><button class=\"newItem\" id=\"addBtn".$user['ID']."\" onclick=\"newItem(".$user['ID'].",'".$user['Name']."','".$user['Username']."',".$user['IsAdmin'].")\">Edit</button></td>";
                        ?>
                        <td>
                            <form action="../components/DeleteUser.php" method="post">
                                <input type='text' name="userID" value="<?php echo $user["ID"] ?>" style="visibility: hidden;width:0.vw"></input>
                                <input type="submit" style="color: red;background-color: black;border: none;" value="X"></input>
                            </form>
                        </td>
                        <?php
                        echo '</tr>';      
                    } 
                ?>
            </table>
        </div>
    </body>
</html>