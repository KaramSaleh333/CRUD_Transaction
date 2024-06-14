<?php

use Controllers\UserController;

include("Controllers/UserController.php");
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);

if(isset($_SESSION['id']) && (time() < $_SESSION['created_at']+3600*2) ){
    header('location: home_page.php');
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $user = new UserController();
    $user->register($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="discreption" content="page to try">
        <title><?php print $website_name ?></title>
    </head>
    <body>
    <form action="" method="POST">
        <div>
            <label for="us">User Name</label>
            <input type="text" id="us" name="user_name" required autofocus>
        </div>
        <br>
        <div>
            <label for="em">Email</label>
            <input type="email" id="em" name="email" required>
        </div>
        <br>
        <div>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="password" required>
        </div>
        <br>
        <div>
            <label for="Confirmpass">Confirm Password</label>
            <input type="password" id="Confirmpass" name="Confirm_password" required>
        </div>
        <?php
            if(isset($_SESSION['validate_error'])){
                echo "<br>".$_SESSION['validate_error'];
                unset($_SESSION['validate_error']);
            }
        ?>
        <div>
            <br>
            <input type="submit" value="Send">
            <input type="reset" value="Reset">
        </div>
    </form>
    <br>
    <a href="login.php">You already have account</a>
    </body>
</html>