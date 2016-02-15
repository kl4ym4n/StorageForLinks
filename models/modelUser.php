<?php
include_once "modelActivation.php";
session_start();
//set variable in appropriate place
$_SESSION['is_auth'] = false;
class User extends GeneralModel
{
    private $login, $email, $password, $name, $surname, $role, $status;

    public function setLogin($user_login)
    {
        $this->login = $user_login;
    }

    public function getLogin()
    {
        //echo $this->login;
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
        $query = $connection->prepare("INSERT INTO Users (login, password, name, surname, email, status) VALUES ('$this->login', '$this->password', '$this->name', '$this->surname', '$this->email', '$this->status')");
        $query->execute();
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

    public function sendEmail($email, $hash, $subject)
    {
        //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."Page";
        $actual_link = "http://$_SERVER[HTTP_HOST]/activation/activate/?hash=$hash";
        $content = "Click this link to activate your account. ". $actual_link;
        $letter = mail($email, $subject, $content);
    }

    public function checkUserLogin(Array $parameters)
    {
        global $connection;
        $userlogin = $parameters["userlogin"];
        $userpassword = $parameters["userpassword"];
        $query = $connection->prepare("SELECT primary_key, login, password, status FROM Users WHERE login = '$userlogin'");
        $query->execute();
        $row = $query->fetchAll();
        $rowCount = $query->rowCount();
        if ($rowCount > 0)
        {
            //make one query!!!
//            $queryPass = $connection->prepare("SELECT password, status FROM Users WHERE login ='$userlogin'");
//            $queryPass->execute();
//            $row = $queryPass->fetchAll();
            if ($this->checkEnteredPassword($userpassword, $row[0]["password"]))
            {
                if ($row[0]["status"] == 0)
                {
                    echo "You need to activate your account first!";
                    $_SESSION['is_auth'] = false;
                }
                else
                {
                    echo "Success login!</br>";
                    //session_start();
                    $_SESSION['is_auth'] = true;
                    $_SESSION['userlogin'] = $row[0]["login"];
                    $_SESSION['userID'] = $row[0]["primary_key"];
                    echo "Hello, ".$_SESSION['userlogin']. "!";
                }
            }
            else
            {
                echo "Incorrect password!";
                $_SESSION['is_auth'] = false;
            }
        }
        else
        {
            echo "Incorrect login!";
            $_SESSION['is_auth'] = false;
        }
    }

    public function checkExistLogin()
    {
        global $connection;
        $query = $connection->prepare("SELECT primary_key, login FROM Users WHERE login ='$this->login'");
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
            $hash = md5(rand(0,1000));
            $offset = "30 minutes";
            $expireTime = $this->getExpireTime($offset);
            $query->execute();
            $row = $query->fetchAll();
            //$userPrimaryKey = $connection->lastInsertId();
            $parameters = array("uid" => $row[0]["primary_key"], "hash" => $hash, "expireTime" => $expireTime);
            $activation = new Activation();
            $activation->fillFields($parameters);
            $activation->addActivationPropertiesToDB();
            $this->sendEmail($this->email, $hash, "Confirm registration");

        }
    }

    public function getAllUserList()
    {
        global $connection;
        $query = $connection->prepare("SELECT * FROM Users");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No users in db";
        }
        else
        {
            foreach ($query as $row)
            {
                echo "User name: {$row['name']} ".
                     "User surname: {$row['surname']} ".
                     "User login: {$row['login']} ".
                     "User email: {$row['email']} ".
                     "User status: {$row['status']} "." <br> ";
            }
        }
    }

    public function getUserProfile()
    {
        global $connection;
        $userID = $_SESSION['userID'];
        //echo $userID;
        $query = $connection->prepare("SELECT * FROM Users WHERE primary_key = '$userID'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such user in db";
        }
        else
        {
            $row = $query->fetchAll();
            return array("name" => $row[0]["name"], "surname" => $row[0]["surname"], "login" => $row[0]["login"], "email" => $row[0]["email"], "password" => $row[0]["password"]);
        }
    }

    public function updateUserProfile($parameters)
    {
        global $connection;
        $userID = $_SESSION['userID'];
        if ($parameters["mail"] == NULL || $parameters["username"] == NULL || $parameters["surname"] == NULL)
        {
            echo "Please, fill empty fields!";
        }
        else
        {
            $mail = $parameters["mail"];
            $username = $parameters["username"];
            $surname = $parameters["surname"];
            $password = $parameters["password"];

            $query = $connection->prepare("UPDATE Users SET email =  '$mail', name = '$username', surname = '$surname' WHERE primary_key = '$userID'");
            $query->execute();
        }
    }

    public function getCurrentDateTime()
    {
        date_default_timezone_set("Asia/Novosibirsk");
        $dt = time();
        $time = date("Y-m-d h:i:s",$dt);
        return $time;
    }

    public function getExpireTime($offset)
    {
        $curTime = $this->getCurrentDateTime();
        $nextTime = date('Y-m-d h:i:s', strtotime($curTime. ' + '.$offset));
        return $nextTime;
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
//$usr->showAllUserList();
//$usr->deleteLink();
//$curTime = $usr->getCurrentDateTime();
//$offset = "2 days";
//$nextTime = date('Y-m-d h:i:s', strtotime($curTime. ' + '.$offset));
//echo "$curTime </br>";
//echo $nextTime;

//$usr->setLogin("kl4ym4n");
//$usr->sendEmail("kl4ym4n@gmail.com", "Registration");
//$usr->setLogin("ololosh");
//$usr->setPassword("1234");
//$usr->setName("Vasya");
//$usr->setSurname("Kozlodoev");
//$usr->setEmail("nagibator@mail.ru");
//$usr->addUserToDB();
//$usr->getLogin();

//$usr2 = new User();
//$usr2->setLogin("ololosh");
//$usr2->checkExistLogin();
