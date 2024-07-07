<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Get the data from the form
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try{
        //order of the files is important
        require "dbh.inc.php"; // Connect to the database
        require "login_model.inc.php";
        require "login_contr.inc.php";
        require "login_view.inc.php";

                //error handling
                $errors = []; //empty array to store the errors. its a associative array
                if(is_input_empty($username, $pwd)){
                    $errors["empty input"] = "Fill in all the fields";
                }
        
                $result = get_user($pdo, $username);
                if (is_username_wrong($result)){
                    $errors["login_incorrect"] = "incorrect login info gg";
                }
                if (!is_username_wrong($result) && !is_password_wrong($pwd, $result["pwd"])){ //if the username is correct and the password is wrong
                    $errors["login_incorrect"] = "incorrect login info gg";

                }
                
        
                require_once "config_seission.inc.php"; // we can say session_start(); here 
                //it will be less safer thats why we use config_session.inc.php
                if ($errors){
                    $_SESSION["errors_login"] = $errors;

                    //print_r($_SESSION["errors_signup"]);
                    header("Location: signup_web.php");
                    die(); //script stops here
                }
                //another way instead of using config file
                $newSessionId = session_create_id(); //this will create an entire new id not regenerate exisiting id
                $sessionId = $newSessionId . "_" . $result["id"]; //this will create a new session id by appending the user id to the new session id
                session_id($sessionId); //this will set the session id to the new session id    

                $_SESSION["user_id"] = $result["id"]; //for database query
                $_SESSION["username"] = htmlspecialchars($result["username"]); //for database query
                $_SESSION['last_regeneration'] = time();

                header("Location: signup_web.php?login=success");
                $pdo = null; // Close the connection
                $stmt = null; // Clean up
                die(); // Stop the script
            }
    catch(PDOException $e){
        die("Query failed" . $e->getMessage());
    }
}
else {
    // Redirect to the signup page if the user tries to access this page directly
    header("Location: signup_web.php");
    die(); // Stop the script
}