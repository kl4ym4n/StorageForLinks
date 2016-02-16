<?php

$checkedFlag = '';
if ($data["flag"] == '0')
{
    $checkedFlag = '';
}
else
{
    $checkedFlag = 'checked';
}

$stringForm = '<form method = post action = "EditLink">
    Header: <input type = text name = "linkheader" value = "'. $data["header"] .'"></br>
    Link: <input type = text name = "userlink" value = "'. $data["link"] .'"></br>
    Description: <textarea rows="10" cols="75" name="linkdescription" >' .$data["description"].
      '</textarea></br>
             <input type="hidden" name="linkflag" value="0" />
    Private: <input type = checkbox name = "linkflag" value = "1" ' .$checkedFlag.' ></br>
    <input type = submit name = "savebutton" value = "Save">
</form>';

echo $stringForm;
