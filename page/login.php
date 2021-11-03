<?php

//checks if user is already loggind in, if yes then redirect them to front page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: overview.php");
    exit;
}
//Define variables and and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Checks if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Indtast brugernavn";
    }
    else{
        $username = trim($_POST["username"]);
    }
    
    // Checks if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //Validate credentials
    if(empty($username_err) && empty ($password_err)){
        //Prepare select statement

        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            //binding variables to preparedstatement and other voodoo things
            $stmt->bind_parameter("s", $param_username);

            //Sets username parameter
            $param_username = $username;

            if($stmt->execute()){
                //Stores result
                $stmt->store_result();

                //check if username exists, if it does then verify password
                if($stmt-> num_rows == 1){
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            //Password is correct so a new session is started
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //redirects user to overview.php
                            header("location: overview.php");
                        }
                        //happens if password is not valid
                        else{
                            $login_err = "Brugernavn eller password er forkert.";
                        }
                    }
                }
                //happens if user doesnt exist
                else {
                    $login_err = "Brugernavn eller password er forkert.";
                }
            }
            else
            {
                echo "noget er gået galt. Prøv igen.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/login.css">
    </head> 

    <body>

        <form action="overview.php" method="post" class="loginForm">
            <?php 
            ?>
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