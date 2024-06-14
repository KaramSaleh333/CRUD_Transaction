<?php
include("constants_variables.php");

session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
if(!isset($_SESSION['id']) && (time() >= $_SESSION['created_at']+3600*2)){
    header('location: login.php');
}
include("Controllers/database_connect.php");
$user = doit($db , "Select * from users where id = '$_SESSION[id]'");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="discreption" content="page to try">
        <title><?php print $website_name ?></title>
    </head>
    <body>
        <p>Name  : <?php print $user['name'] ?>  </p>
        <p>Email : <?php print $user['email'] ?>  </p>
        <p>The Account Created in <?php print substr($user['created_at'] , 0 , 4) ?>  </p>
    </body>
</html>
