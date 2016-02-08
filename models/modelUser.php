<?php
//include('index.php');
//include('generalModel.php');
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

    public function registerUser(Array $parameters)
    {
        if ($parameters["login"] == NULL || $parameters["mail"] == NULL || $parameters["username"] == NULL || $parameters["surname"] == NULL || $parameters["password"] == NULL)
        {
            echo "Please, fill empty fields!";
        }
        else
        {
            if ($parameters["password"] != $parameters["repassword"])
            {
                echo "Incorrect repeated password!";
                //echo $string_form;
            }
            else
            {
                $this->setLogin($parameters["login"]);
                $this->setEmail($parameters["mail"]);
                $this->setName($parameters["username"]);
                $this->setSurname($parameters["surname"]);
                $hash = password_hash($parameters["password"], PASSWORD_DEFAULT);
                $this->setPassword($hash);
                $this->setStatus(0);
                $this->setRole(0);
                $this->checkExistLogin();
            }
        }
    }

    public function sendEmail($email, $subject)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."Page";
        //$message = "Please, follow the link below to complete registration!";
        $content = "Click this link to activate your account. ". $actual_link;
        //$mail = 'kl4ym4n@gmail.com';
        //$subj = 'Registration';
        $letter = mail($email, $subject, $content);
    }

    public function checkUserLogin(Array $parameters)
    {
        global $connection;
        $userlogin = $parameters["userlogin"];
        $userpassword = $parameters["userpassword"];
        $query = $connection->prepare("SELECT login FROM Users WHERE login = '$userlogin'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount > 0)
        {
            $queryPass = $connection->prepare("SELECT password, status FROM Users WHERE login ='$userlogin'");
            $queryPass->execute();
            $row = $queryPass->fetchAll();
            //echo $row[0]["password"];
            //$rowCountPass = $queryPass->rowCount();
            if ($this->checkEnteredPassword($userpassword, $row[0]["password"]))
            {
                if ($row[0]["status"] == 0)
                {
                    echo "You need to activate your account first!";
                }
                else
                {
                    echo "Success!";
                }
            }
            else
            {
                echo "Incorrect password!";
            }
        }
        else
        {
            echo "Incorrect login!";
        }
    }

    public function checkExistLogin()
    {
        global $connection;
        $query = $connection->prepare("SELECT login FROM Users WHERE login ='$this->login'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount > 0)
        {
            echo "User already exist!";
        }
        else
        {
            echo "You're successfully registered! Check your email for confirmation link.";
            $this->addUserToDB();
            $this->sendEmail($this->email, "Confirm registration");
        }
    }

    public function checkEnteredPassword($password, $hash)
    {
        if (password_verify($password, $hash))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

//$usr = new User();
//$usr->setLogin("ololosh");
//$usr->setPassword("1234");
//$usr->setName("Vasya");
//$usr->setSurname("Kozlodoev");
//$usr->setEmail("nagibator@mail.ru");
////$usr->addUserToDB();
//$usr->getLogin();
//
//$usr2 = new User();
//$usr2->setLogin("ololosh");
//$usr2->checkExistLogin();
