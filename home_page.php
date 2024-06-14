<?php
use Controllers\UserController;

include("Controllers/UserController.php");
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
if(!isset($_SESSION['id']) && (time() >= $_SESSION['created_at']+3600*2) ){
    header('location: login.php');
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $user = new UserController();
    $user->logout();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="discreption" content="page to try">
    <title> <?php print $website_name ?></title> 
</head>
<body>
    <h1><?php print $website_name ?></h1>
    <p>if you want to edit your information press <a href="http://localhost/php_backend_learning/trying_projects/first_project/edit_info.php">here</a></p>
    <p>if you want to delete your account press <a href="http://localhost/php_backend_learning/trying_projects/first_project/delete_account.php">here</a></p>
    <p>if you want to know your information press <a href="http://localhost/php_backend_learning/trying_projects/first_project/show_data.php">here</a></p>
    
    <form action="" method="post">
    <p> logout 
        <input type="submit" value="here">
    </p>
    </form>

</form>
</body>
</html>
