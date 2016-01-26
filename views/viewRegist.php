<?php

$string_form = '<form method = post action = Index>

        Login: <input type = text name = "login" value ="' . $_POST["login"] . '"> </br>
        Mail: <input type = text name = "mail" value = ""></br>
        Name: <input type = text name = "username" value = ""></br>
        Surname: <input type = text name = "surname" value = ""></br>
        Password: <input type = password name = "password" value = ""></br>
        Repeat password : <input type = password name = "repassword" value = ""></br>

        <input type = submit name = "regbutton " value = "Enter!">

    </form>';

echo $string_form;

?>