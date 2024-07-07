<?php

    declare(strict_types=1);
    
    function get_username(object $pdo, string $username){
        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        //above line: we seperate the query from the data to prevent sql injection
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        //fetch the data means we are getting the data from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the data as an associative array
        return $result;
    }


    function get_email(object $pdo, string $email){
        $query = "SELECT email FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        //above line: we seperate the query from the data to prevent sql injection
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        //fetch the data means we are getting the data from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the data as an associative array
        return $result;
    }

    function set_user(object $pdo, string $username, string $pwd, string $email){
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
        $stmt = $pdo->prepare($query);
        //above line: we seperate the query from the data to prevent sql injection
        $options = ['cost' => 12]; //cost is the number of times the password is hashed
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options); //hash the password
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        //fetch the data means we are getting the data from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the data as an associative array
        return $result;
    }