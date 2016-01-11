<?php
include ('index.php');
include ('generalModel.php');
class User extends GeneralUser
{
    private $login, $email, $password, $name, $surname, $role, $status;

    public function setLogin($user_login)
    {
        $this->login = $user_login;
    }
    public function getLogin()
    {
        echo $this->login;
        return $this->login;

    }
    public function setEmail($user_email)
    {
        $this->email = $user_email;
    }
    public function getEmail()
    {

        return $this->email;

    }
    public function setPassword($user_pass)
    {
        $this->password = $user_pass;
    }
    public function getPassword()
    {
        return $this->password;

    }
    public function setName($user_name)
    {
        $this->name = $user_name;
    }
    public function getName()
    {
        return $this->name;

    }
    public function setSurname($user_surname)
    {
        $this->surname = $user_surname;
    }
    public function getSurname()
    {
        return $this->surname;

    }
    public function setStatus($user_status)
    {
        $this->status = $user_status;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setRole($user_role)
    {
        $this->role = $user_role;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function addUserToDB()
    {
        global $connection;
        $sql = "INSERT INTO Users (login, password, name, surname, email) VALUES ('$this->login', '$this->password', '$this->name', '$this->surname', '$this->email')";
        $connection->exec($sql);
    }

    public function userLogin()
    {

    }
    public function checkExistLogin()
    {

        global $connection;
        $query = $connection->query("SELECT login FROM Users WHERE login ='$this->login'");
        $rowCount = $query->rowCount();
        if($rowCount > 0)
        {
            echo "User already exist!";
        }
        else
        {
            echo "Ok!";
        }
    }
    //var_dump($sql);

        //var_dump($connection);
}

$usr = new User();
$usr->setLogin("ololosh");
$usr->setPassword("1234");
$usr->setName("Vasya");
$usr->setSurname("Kozlodoev");
$usr->setEmail("nagibator@mail.ru");
//$usr->addUserToDB();
$usr->getLogin();

$usr2 = new User();
$usr2->setLogin("ololosh");
$usr2->checkExistLogin();
