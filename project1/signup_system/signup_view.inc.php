<?php

declare(strict_types=1);

function check_signup_errors(){
    if (isset($_SESSION["errors_signup"])){
        $errors = $_SESSION["errors_signup"];

        
        echo "<br>";
        
        foreach($errors as $error){
            echo "<p style='color:red;'> $error </p>";
        }

        unset($_SESSION["errors_signup"]); //remove the session variable
    } else if(isset($_GET["signup"]) && $_GET["signup"] == "success"){
        echo "<br>";
        echo "<p style='color:green'> Signup successful </p>";
    }
}

function signup_inputs(){
 
    //check if the user has entered any data and if the username is not taken 
    if(isset($_SESSION["signup_data"]["username"])){
        echo "username is ok";
        
    }
    if(isset($_SESSION["signup_data"]["username"]) && empty($_SESSION["errors_signup"]["username_taken"])){
        echo '<input type="text" name="username" placeholder="Username" value= "'.  htmlspecialchars($_SESSION["signup_data"]["username"]) . '">';
    }
    else { //if the user has not entered any data or the username is taken
        echo "something wrong with the username";
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    //check if the user has entered any data and if the email is not taken
    if(isset($_SESSION["signup_data"]["email"]) && empty($_SESSION["errors_signup"]["invalid_email"]) && empty($_SESSION["errors_signup"]["email_registered"])){
        echo '<input type="text" name="email" placeholder="Email" value= "'.  htmlspecialchars($_SESSION["signup_data"]["email"]) . '">';
    }
    else { //if the user has not entered any data or the username is taken
        echo '<input type="text" name="email" placeholder="Email">';
    }

}