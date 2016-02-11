<?php



$user = 'root';
$pass = 'azarta';

$connection = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $connection->prepare("DELETE FROM ActivationLinks WHERE expire_time < NOW()");
$query->execute();



