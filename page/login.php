<?php
//Define variables and initialize with empty value
$userpassword = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/login.css">
    </head> 

    <body>

        <form action="overview.php" method="post" class="loginForm">
                <label for="uname" style="font-size: 3vh;"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required><br>

                <label for="psw" style="font-size: 3vh;"><b>Password </b></label>
                <input type="password" placeholder="Enter Password" name="psw" required><br>
                <label style="font-size: 2vh;">
                    Remember me
                    <input style="margin-top: 5vh;font-size: 5vh; margin-top: 1vh;" type="checkbox" checked="checked" name="remember"> 
                </label><br>
                <span class="psw" style="font-size: 2vh;">Forgot <a href="#">password?</a></span>
                <button type="submit" style="float: right;margin-right: 9vw;margin-top: -3vh;">Login</button><br>
        </form> 

    </body>
</html> 