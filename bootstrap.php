<?php
require_once 'core/generalModel.php';
require_once 'core/generalView.php';
require_once 'core/generalController.php';
require_once 'core/route.php';
require_once 'autoloader.php';
Route::start();

class Boot
{
    protected  $user, $password, $connection;
    public function __construct()
    {
        $this->user = 'root';
        $this->password = 'azarta';
        $connection = new PDO('mysql:host=localhost; dbname=mydb', $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
