<?php

session_start(); //we need to start the session to destroy it
session_unset();
session_destroy();
header("Location: signup_web.php"); //redirect to the signup page
die(); //stop the script