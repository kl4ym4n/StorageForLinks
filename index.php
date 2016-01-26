<?php
$user = 'root';
$pass = 'azarta';
try
{
    $connection = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

ini_set('display_errors', 1);
require_once 'bootstrap.php';


//echo "Waiting...";