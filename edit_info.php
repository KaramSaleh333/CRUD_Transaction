<?php

use Controllers\UserController;

include("Controllers/UserController.php");
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
if(!isset($_SESSION['id']) && (time() >= $_SESSION['created_at']+3600*2) ){
    header('location: login.php');
}


if($_SERVER['REQUEST_METHOD']==="POST"){
    $obj = new UserController();
    $obj->update($_POST);
}

$obj = new UserController();
$user = doit($obj->db , "Select * from users where id = '$_SESSION[id]' ");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="discreption" content="page to try">
        <title><?php print $website_name ?></title>
    </head>
    <body>
    <h2>Change Your Name and  Email</h2>
    <form action="" method="POST">
        <div>
            <label for="us">New User Name</label>
            <input type="text" id="us" name="user_name" value="<?php print $user['name']?>" required >
        </div>
        <br>
        <div>
            <label for="em">New Email</label>
            <input type="email" id="em" name="email" value="<?php print $user['email']?>" required>
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
    <p>---------------------------------------------------------------------------------------------------</p>
    <h2>Change Your Password</h2>
    <form action="" method="POST">
        <div>
            <label for="pass">New Password</label>
            <input type="password" id="pass" name="password" required>
        </div>
        <br>
        <div>
            <label for="confpass">Confirm Password</label>
            <input type="password" id="confpass" name="Confirm_password" required>
        </div>
        <?php
            if(isset($_SESSION['password_error'])){
                echo "<br>".$_SESSION['password_error'];
                unset($_SESSION['password_error']);
            }
        ?>
        <div>
            <br>
            <input type="submit" value="Send">
            <input type="reset" value="Reset">
        </div>
    </form>

    </body>
</html>