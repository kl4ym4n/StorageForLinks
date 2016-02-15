<?php
$stringForm = '<form method = post action = "UpdateProfile">

    Login: <input type = text name = "login" value = "'. $data["login"] .'" disabled> </br>
    Mail: <input type = text name = "mail" value = "'. $data["email"] .'"></br>
    Name: <input type = text name = "username" value = "'. $data["name"] .'"></br>
    Surname: <input type = text name = "surname" value = "'. $data["surname"] .'"></br>
    Password: <input type = password name = "password" value = ""></br>
    <input type = submit name = "savebutton " value = "Save">

</form>';

echo $stringForm;
