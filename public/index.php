<?php
require('../dbconnect.php');

if (isset($_POST["uname"]) && isset($_POST["psw"])){
    $stmt = $conn->prepare("SELECT Username, Password FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $_POST["uname"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    echo $user["Username"];
    echo $user["Password"];

    if($_POST["psw"] == $user["Password"]){
        header("location: overview.php");
        Die();
    }
} ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/login.css">
    </head> 

    <body>
        <div class="wrapper">
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                } 
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="loginForm">
                        <label for="uname" style="font-size: 3vh;"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <br>
                        
                        <label for="psw" style="font-size: 3vh;"><b>Password </b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required><br>
                        <label style="font-size: 2vh;">
                            Remember me
                            <input style="margin-top: 5vh;font-size: 5vh; margin-top: 1vh;" type="checkbox" checked="checked" name="remember"> 
                        </label><br>
                        <span class="psw" style="font-size: 2vh;">Forgot <a href="#">password?</a></span>
                        <button type="submit" style="float: right;margin-right: 9vw;margin-top: -3vh;">Login</button><br>
                </form> 
        </div>
    </body>
</html> 