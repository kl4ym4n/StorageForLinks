<?php

$stringForm = '<form method = post action = "EditLink">
    Header: <input type = text name = "linkheader" value = ""></br>
    Link: <input type = text name = "userlink" value = ""></br>
    Description: <textarea rows="10" cols="75" name="linkdescription" ></textarea></br>
    Private: <input type = checkbox name = "linkflag" value = "1"></br>
    <input type = submit name = "savebutton" value = "Save">
</form>';

echo $stringForm;
