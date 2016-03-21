<?php
include_once "modelActivation.php";
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
        //global $connection;
        $query = $this->connection->prepare("INSERT INTO Users (login, password, name, surname, email, status) VALUES ('$this->login', '$this->password', '$this->name', '$this->surname', '$this->email', '$this->status')");
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
                $alertMessage ='<div class="alert alert-danger">Incorrect repeated password!</div>';
                echo $alertMessage;
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
                $this->setRole(2);
                $this->checkExistLogin();
            }
        }
    }

    public function checkExistLogin()
    {
        //global $connection;
        $query = $this->connection->prepare("SELECT primary_key, login FROM Users WHERE login ='$this->login'");
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
            $this->setUserRole($row[0]["primary_key"], $this->getRole());
            $parameters = array("uid" => $row[0]["primary_key"], "hash" => $hash, "expireTime" => $expireTime);
            $activation = new Activation();
            $activation->fillFields($parameters);
            $activation->addActivationPropertiesToDB();
            $this->sendEmail($this->email, $hash, "Confirm registration");

        }
    }

    public function sendEmail($email, $hash, $subject)
    {
        //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."Page";
        $actual_link = "http://$_SERVER[HTTP_HOST]/activation/activate/?hash=$hash";
        $content = "Click this link to activate your account. ". $actual_link;
        $letter = mail($email, $subject, $content);
    }

    public function userLogout()
    {
        if (isset($_SESSION['userID']))
        {
            $_SESSION['userID'] = null;
            session_unset();
            session_destroy();
        }
    }

    public function checkUserLogin(Array $parameters)
    {
        //global $connection;
        $userlogin = $parameters["userlogin"];
        $userpassword = $parameters["userpassword"];
        $query = $this->connection->prepare("SELECT primary_key, login, password, status FROM Users WHERE login = '$userlogin'");
        $query->execute();
        $row = $query->fetchAll();
        $rowCount = $query->rowCount();
        if ($rowCount > 0)
        {
            if ($this->checkEnteredPassword($userpassword, $row[0]["password"]))
            {
                if ($row[0]["status"] == 0)
                {
                    echo "You need to activate your account first!";
                    $_SESSION['userID'] = null;
                }
                else
                {
                    echo "Success login!</br>";
                    $_SESSION['userID'] = $row[0]["primary_key"];
                }
            }
            else
            {
                echo "Incorrect password!";
                $_SESSION['userID'] = null;
            }
        }
        else
        {
            echo "Incorrect login!";
            $_SESSION['userID'] = null;
        }
    }

    public function getAllUserList()
    {
        //$connection = $this->getConnection();
        //$connection = $this->connection;
        //var_dump($this->getConnection());
        $recLimit = 3;
        $data = array();
        $userID = array();
        $queryCount = $this->connection->prepare("SELECT primary_key FROM Users");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = ceil ($rowCount / $recLimit);
        if (isset($_GET{'page'} ))
        {
            $page = $_GET{'page'};
            $offset = $recLimit * $page ;
        }
        else
        {
            $page = 0;
            $offset = 0;
        }

        $query = $this->connection->prepare("SELECT * FROM Users LIMIT $offset, $recLimit");
        $query->execute();
        if($rowCount == 0)
        {
            echo "No users in db";
        }
        else
        {
            //$row = $query->fetchAll();
            //echo $pageCount;
            foreach ($query as $result)
            {
                $row = array("name" => $result["name"], "surname" => $result["surname"], "login" => $result["login"],
                    "email" => $result["email"], "status" => $result["status"]);
                $data[] = $row;
                $userID[] = $result['primary_key'];
            }
        }
        $params = array($userID, $data, $page, $pageCount, $recLimit);
        return $params;
    }

    public function getUserProfile($userID)
    {
        //global $connection;
        $params = array();
        $roleList = array();
        if (isset($_SESSION['userID'])) {

            $query = $this->connection->prepare("SELECT * FROM Users WHERE primary_key = '$userID'");
            $query->execute();
            $rowCount = $query->rowCount();

            $queryRole = $this->connection->prepare("SELECT * FROM Roles ");
            $queryRole->execute();
            $rowRoleCount = $queryRole->rowCount();
            foreach ($queryRole as $result)
            {
                $row = array("role_id" => $result["primary_key"], "role" => $result["role"]);
                $roleList[] = $row;
            }
            if($rowCount == 0)
            {
                echo "No such user in db";
            }
            else
            {
                $row = $query->fetchAll();
                $role = $this->getUserRole($userID);
                $params = array("id" => $row[0]["primary_key"],"name" => $row[0]["name"], "surname" => $row[0]["surname"], "login" => $row[0]["login"], "email" => $row[0]["email"],
                    "password" => $row[0]["password"], "status" => $row[0]["status"], "role" => $role, "roleList" => $roleList);
            }
            return $params;
        }
        else
        {
            echo 'You need to sign first';
            return $params;
        }
    }

    public function getUserRole($userID)
    {
        //global $connection;
        $query = $this->connection->prepare("SELECT role_id FROM UserRoles WHERE user_id = '$userID'");
        $query->execute();
        $role = array();

        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such user in db";
        }
        else
        {
            $row = $query->fetchAll();
            $roleID = $row[0]["role_id"];
            $roleQuery = $this->connection->prepare("SELECT role FROM Roles WHERE primary_key = '$roleID'");
            $roleQuery->execute();
            $roleRowCount = $roleQuery->rowCount();
            if($roleRowCount == 0)
            {
                echo "No such role in db";
            }
            else
            {
                $row = $roleQuery->fetchAll();
            }
        }
        $role[] = $row[0]["role"];
        $role[] = $roleID;
        return $role;
    }

    public function setUserRole($userID, $roleID)
    {
        //global $connection;
        $query = $this->connection->prepare("INSERT INTO UserRoles (user_id, role_id) VALUES ('$userID', '$roleID')");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such user in db";
        }
    }

    public function updateUserProfile($parameters, $userID)
    {
        //global $connection;
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
            $flag = $parameters["flag"];
            $role = $parameters["role"];
            //echo $role;
            if ($password != NULL)
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = $this->connection->prepare("UPDATE Users SET password =  '$hash' WHERE primary_key = '$userID'");
                $query->execute();
            }
            $query = $this->connection->prepare("UPDATE Users SET email = '$mail', name = '$username', surname = '$surname', status = '$flag' WHERE primary_key = '$userID'");
            $query->execute();
            $this->changeRole($userID, $role);
        }
    }

    public function deleteUser($userID)
    {
        if (isset($_SESSION['userID']))
        {
            $query = $this->connection->prepare("DELETE FROM Users WHERE primary_key = $userID");
            $query->execute();
            $queryLinks = $this->connection->prepare("DELETE FROM Links WHERE user_id = $userID");
            $queryLinks->execute();
            $queryRole = $this->connection->prepare("DELETE FROM UserRoles WHERE user_id = $userID");
            $queryRole->execute();
        }
    }

    public function changeRole($userID, $roleID)
    {
        //global $connection;
        $query = $this->connection->prepare("UPDATE UserRoles SET role_id = '$roleID' WHERE user_id = '$userID'");
        $query->execute();
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
