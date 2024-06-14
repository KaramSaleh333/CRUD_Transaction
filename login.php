<?php

use Controllers\UserController;

include("Controllers/UserController.php");
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
if(isset($_SESSION['id']) && (time() < $_SESSION['created_at']+3600*2)){
    header('location: home_page.php');
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $user = new UserController();
    $user->login($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="discreption" content="page to try">
    <meta name="viewport">
    <title> <?php print $website_name ?></title>
</head>
<body>
    <form action="" method="POST">
    <div>
        <label for="em">Email</label>
        <input type="email" name="email" id="em" required autofocus>
    </div>
    <br>
    <div>
        <label for="pass">Password</label>
        <input type="password" name="password" id="pass" required>
    </div>
    <?php
            if(isset($_SESSION['login_error'])){
                echo "<br>".$_SESSION['login_error'];
                unset($_SESSION['login_error']);
            }
        ?>
    <div>
        <br>
        <input type="submit" value="Send">
        <input type="reset" value="Reset">
    </div>
    </form>
    <br>
    <a href="creat_account.php">You don't have account</a>
</body>
</html>
