<?php
require_once 'core/generalModel.php';
require_once 'core/generalView.php';
require_once 'core/generalController.php';
require_once 'core/route.php';
require_once 'autoloader.php';
session_start();
Route::start();


class Boot
{
    protected  $user, $password;
    public function __construct()
    {

    }

    static function getConnection()
    {
        static $connection;
        $user = 'root';
        $password = 'azarta';
        if (!isset($connection))
        {
            $connection = new PDO('mysql:host=localhost; dbname=mydb', $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "done!";
        }
        if ($connection == false)
        {
            echo "Cannot connect to database!";
            return 0;
        }
        return $connection;
    }
}
