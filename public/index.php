<?php
//$user = 'root';
//$pass = 'azarta';
//try
//{
//    $connection = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);
//    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
//catch (PDOException $e) {
//    print "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}
//exit;
ini_set('display_errors', 1);
require_once '../bootstrap.php';
$bootstrap = new Boot();

//echo "Waiting...";