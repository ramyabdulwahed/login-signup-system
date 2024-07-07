<?php

declare(strict_types=1);

function output_username(){
    if(isset($_SESSION["user_id"])){
        echo "Your are logged in as" . $_SESSION["username"];
    }
    else{
        echo "You are not logged in gg";
    }
}

function check_login_errors(){
    if(isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo "<br>";
        foreach($errors as $error){
            echo "<p style='color:red;'> $error </p>";
        }
        unset($_SESSION["errors_login"]); //remove the session variable
    }
    else if(isset($_GET["login"]) && $_GET["login"] == "success"){
            echo "<br>";
            echo "<p style='color:green'> Login successful </p>";
    }
}