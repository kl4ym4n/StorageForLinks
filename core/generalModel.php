<?php

class GeneralModel
{
    protected  $connection;
    public $modelName;
    public function  __construct()
    {
        $this->connection = Boot::getConnection();
    }
    public function getConnection()
    {
        return $this->connection;
    }
    public function printSmth()
    {
        echo "Ololo!";
    }
}