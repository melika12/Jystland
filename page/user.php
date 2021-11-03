<?php
    require('menu.php');
    include_once('../dbconnect.php')
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/user.css">
    </head> 
    <body>
        <button class="newItem">New user</button>
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>IsAdmin</th>
                    <th>Created</th>
                    <th>Modified</th>
                </tr>
                    <?php 
                        $users = "SELECT * FROM Users;";
                        $result = mysqli_query($conn, $users);
                        foreach ($result AS $user) {
                            echo '<tr>';
                            echo '<td>' . utf8_encode($user['Name']) . '</td>';                    
                            echo '<td>' . utf8_encode($user['Username']) . '</td>';                    
                            echo '<td>' . utf8_encode($user['IsAdmin']) . '</td>';                    
                            echo '<td>' . utf8_encode($user['CreatedDate']) . '</td>';                    
                            echo '<td>' . utf8_encode($user['ModifiedDate']) . '</td>';       
                            echo '</tr>';      
                        } 
                    ?>
            </table>
        </div>
    </body>
</html>