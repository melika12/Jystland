<?php
    require('menu.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/user.css">
    </head> 
    <body>  
    <button class="newUser">New User</button>    
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Admin</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Edit user</th>
                    <th>Delete user</th>
                </tr>
                <tr>
                    <td>Loke</td>
                    <td>Gud#1</td>
                    <td>**********</td>
                    <td>Yes</td>
                    <td>01/11/21</td>
                    <td>01/11/21</td>
                    <td><button>Edit</button></td>
                    <td><button>Delete</button></td>
                </tr>
                <tr>
                    <td>Marcus</td>
                    <td>Møgunge</td>
                    <td>****************</td>
                    <td>No</td>
                    <td>01/11/21</td>
                    <td>01/11/21</td>
                    <td><button>Edit</button></td>
                    <td><button>Delete</button></td>
                </tr>
            </table>
        </div>

    </body>
</html>