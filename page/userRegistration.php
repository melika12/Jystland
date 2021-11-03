<?php
//Define variables and initialize with empty value
$userpassword = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Indtast brugernavn";
    }
    elseif(!validCharacters('/^[a-aA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Brugernavnet kan kun indeholde bogstaver, tal og underscore.";
    }
    else{
        //Prepare select statement and some voodoo magic
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = $mysqli ->prepare($sql)){
            $stmt->bind_params("s", $param_username);

            $param_username = trim($_POST["username"]);

            //hopefully executes prepared statement
            if($stmt->execute()){
                //Stores result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $username_err = "Brugernavnet er allerede taget. Vælg venligst et andet.";
                }
                else{
                    $username = trim($_POST["username"]);
                }
                else{
                    echo "Et eller andet mystisk gik galt. Prøv igen";
                }

                $stmt->close();
            }
        }
    }
}

?>