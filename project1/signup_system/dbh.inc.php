<?php
//needed variables to connect to the database
$host = "localhost";
$dbname = "myfirstdatabase";
$dbusername = "root";
$dbpassword = "";
//creating a new PDO object based on a connection class
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    //$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword"); //creating a new PDO object based on a connection class
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setting the error mode attribute of the PDO object to ERRMODE_EXCEPTION WHICH MEANS THAT PDO WILL THROW AN EXCEPTION WHEN AN ERROR OCCURS

} catch(PDOException $e){
    die("Connection failed: ". $e->getMessage()); //terminates the script if something goes wrong
}

