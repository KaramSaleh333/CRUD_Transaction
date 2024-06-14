<?php
use Controllers\UserController;

include("Controllers/UserController.php");
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
if(!isset($_SESSION['id']) && (time() >= $_SESSION['created_at']+3600*2)){
    header('location: login.php');
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $user = new UserController();
    $user->delete();
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
      
        <form action="" method="post">
        <p>if you are sure you want to delete your account pls press 
            <input type="submit" value="here">
        </p>
        </form>
      
    </body>
</html>
