<?php

$dns = "mysql:host=localhost;dbname=try";
$user = "root";
$pass = "";

$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
];
$db = new PDO($dns , $user , $pass , $options);
$db->setATTribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

function doit($db , $query){
    $pre = $db->prepare($query);
    $pre->execute();
    $result = $pre->fetch(PDO::FETCH_ASSOC);
    return $result;
}

?>