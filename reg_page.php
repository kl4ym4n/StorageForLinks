<?php
session_start();
//$login = "user";
//$pass = "qwerty";
$string_form = '<form method = post action = reg_page.php>

        Login: <input type = text name = "login" value ="' . $_POST["login"] . '"> </br>
        Password: <input type = password name = "password" value = ""></br>
        Repeat password : <input type = password name = "repassword" value = ""></br>

        <input type = submit name = "regbutton " value = "Enter!">

    </form>';
    ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['password'] != $_POST['repassword'])
    {
        echo "Incorrect password!";
        echo $string_form;
    }
    else
    {
        $user = 'root';
        $pass = 'azarta';
        $rec_limit = 5;

        echo $string_form;
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        try {
            $dbh = new PDO('mysql:host=localhost; dbname=mydb', $user, $pass);
            if ($login != NULL && $password != NULL)
            {
                $sql = "INSERT INTO Logins (login, password) VALUES ('$login', '$password')";
            }
            //var_dump($sql);
            $dbh->exec($sql);

            $queryCount = $dbh->query("SELECT * FROM Posts",  PDO::FETCH_LAZY);
            $rowCount = $queryCount->rowCount();
            $pageCount = round ($rowCount / $rec_limit);

//        foreach ($query as $row)
//        {
//            echo "<div style ='font:21px Arial,tahoma,sans-serif;color:#ff0000'> {$row["title"]} </div> " . " " .  $row["message"] . "</br>";
//        }
            //$retval = $dbh->query("SELECT count(title) FROM Posts", PDO::FETCH_LAZY);
            //echo $retval;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        if ($login != NULL && $password != NULL && $repassword != NULL)
        {
            echo "You're successfully registered! Go to login page=> <a href= \"login_page.php\" >" . "Login page </a> ";
        }
        else
        {
            echo "Ololo, fill empty fields!!";
        }

    }
}
else
{
    echo $string_form;
}








