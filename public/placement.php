<?php
    require('menu.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/placement.css">
    </head> 
    <body>  
    <button class="newPlacement">New Placement</button>    
        <div class="overviewItem">
            <table>
                <tr>
                    <th>Row number</th>
                    <th>Shelf number</th>
                    <th>Placement number</th>
                    <th>Edit placement</th>
                    <th>Delete placement</th>
                </tr>
                <tr>
                    <td>2</td>
                    <td>24</td>
                    <td>12</td>
                    <td><button>Edit</button></td>
                    <td><button>Delete</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                    <td><button>Edit</button></td>
                    <td><button>Delete</button></td>
                </tr>
            </table>
        </div>

    </body>
</html>