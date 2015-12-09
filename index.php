<?php

class User
{
    private $login, $email, $password, $name, $surname;
    public function setLogin($user_login)
    {
        $this->login = $user_login;
    }
    public function getLogin()
    {
        echo $this->login;
        return $this->login;

    }
}

$usr = new User();
$usr->setLogin("Anton");
$usr->getLogin();