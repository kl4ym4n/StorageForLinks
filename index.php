<?php
require 'libraries/PHPMailerAutoload.php';
$user = 'root';
$pass = 'azarta';
//echo "Ololo!";
try
{
    $connection = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

echo "Waiting...";