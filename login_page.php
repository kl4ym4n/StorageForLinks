
    <?php
    session_start();
    $user = 'root';
    $pass = 'azarta';
    //$login = "user";
    //$pass = "qwerty";
    ?>
        <form method = post action = login_page.php>

        Login: <input type = text name = "login" value = ""></br>
        Password: <input type = password name = "password" value = ""></br>
            <input type = submit name = "loginbutton" value = "Enter!">
            <input type = submit name = "registration" value = "Registration">
        </form>
    <?php



    if ($_POST['registration'])
    {
        header("Location: http://test1/reg_page.php");
    }
    if ($_POST['loginbutton'])
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($login != NULL && $pass != NULL)
        {

            try {
                $dbh = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);

                //echo $login;
                //$query = $dbh->query("SELECT password FROM Logins WHERE login = $login",  PDO::FETCH_LAZY);
                //$res = $query->fetchAll();
                $query = $dbh->prepare("SELECT password FROM Logins WHERE login = ?");
                $query->execute(array($login));
                $res = $query->fetchAll();
                //echo $res[0]["password"];
//        foreach ($query as $row)
//        {
//            echo "Title: {$row['title']} ".
//                "Message: {$row['message']} <br> ";
//
//        }
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            //var_dump($res[0]["password"]);
            if ($password == $res[0]["password"])
            {

                $_SESSION['is_auth'] = true;
                $_SESSION['name'] = $login;
                header("Location: http://test1/page2.php");
            }
            else
            {
                $_SESSION["is_auth"] = false;
                echo "Incorrect data! Please reenter fields";
            }
        }
        else
        {
            echo "Ololo, fill empty fields!";
        }
    }









