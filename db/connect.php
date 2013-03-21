<?php

$dsn = 'mysql:host = localhost; dbname=cercetare';

try{
    $pdo = new PDO($dsn, "root", "acid77burn", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}  catch(PDOException $e){
    die("Eroare:" . $e->getMessage());
};

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
