<?php
    require_once "config_seission.inc.php"; //we need to make a session is started
    require_once "signup_view.inc.php";
    require_once "login_view.inc.php";
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>
<body>

<?php
/*        
        if (isset($_SESSION["errors_signup"])) {
            echo "its is entering the if statement";
            $errors = $_SESSION["errors_signup"];
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION["errors_signup"]); // Clear errors after displaying
        }*/
        //echo "its is not entering the if statement";
        
        check_signup_errors(); 
    ?>

    <h4> 
    <?php 
    output_username(); 
    ?> 
    </h4>
    <h1> Login</h1>
    <form action="login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="submit">Login</button>
    </form>

    <?php
        check_login_errors();
    ?>


    <h2> Sign up</h2>
    <form action="signup.inc.php" method="post">
        <?php
            signup_inputs();
        ?>
        <button type="submit" name="submit">Sign up </button>
    </form>

    <h1> Logout</h1>
    <form action="logout.inc.php" method="post">
        <button type="submit" name="submit">Logout</button>
    </form>



</body>
</html>