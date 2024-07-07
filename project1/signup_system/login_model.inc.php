<?php

declare(strict_types=1);

    function get_user(object $pdo, string $username){

        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        //above line: we seperate the query from the data to prevent sql injection
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        //fetch the data means we are getting the data from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch the data as an associative array
        return $result;

    }