<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
/*
    $username = $_POST["username"] ?? '';
    $pwd = $_POST["pwd"] ?? '';
    $email = $_POST["email"] ?? '';
*/
    try{
        require_once "dbh.inc.php";
        require_once "signup_module.inc.php"; //model always becomes before controller
        require_once "signup_contr.inc.php";

        //error handling
        $errors = []; //empty array to store the errors. its a associative array
        if(is_input_empty($username, $pwd, $email)){
            $errors["empty input"] = "Fill in all the fields";
        }

        //check if email is invalid
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email";
        }

        if (is_username_taken($pdo, $username)){
            $errors["username_taken"] = "Username is already taken gg";
        }
        if (email_registered($pdo, $email)){
            $errors["email_registered"] = "Email is already registered";

        }

        require_once "config_seission.inc.php"; // we can say session_start(); here 
        //it will be less safer thats why we use config_session.inc.php
        if ($errors){
            $_SESSION["errors_signup"] = $errors;
            $signupdata = ["username" => $username, "email" => $email]; //associative array
            $_SESSION["signup_data"] = $signupdata;
            //print_r($_SESSION["errors_signup"]);
            header("Location: signup_web.php");
            die(); //script stops here
/*
            echo "Setting session errors: ";
            print_r($errors);
    
            $_SESSION["errors_signup"] = $errors;
            // Debug statement
            echo "Session errors set: ";
            print_r($_SESSION["errors_signup"]);
    
            header("Location: signup_web.php");
            exit(); // Ensure script stops execution here
        }
            */
        }
            //if no errors, create the user
        create_user($pdo, $username, $pwd, $email);
        header("Location: signup_web.php?signup=success");
        $pdo = null; //close the connection
        $stmt = null; //close the statement
        die(); //script stops here
} 
    catch (PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());

    }

}
else{
    header("Location: signup_web.php");
    die(); //script stops here
}