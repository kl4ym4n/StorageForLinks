
//echo "Header: " . $data["header"] .
//    " Link: " . $data["link"] .
//    " Description: " . $data["description"] .
//    " Private flag:" . $data["flag"];

<?php

$stringForm = '<form method = post action = "ViewLink">
    Header: <input type = text name = "linkheader" value = "'. $data["header"] .'" disabled></br>
    Link: <input type = text name = "userlink" value = "'. $data["link"] .'" disabled></br>
    Description: <textarea rows="10" cols="75" name="linkdescription" disabled>' .$data["description"].
    '</textarea></br>
    Private: <input type = checkbox name = "linkflag" value = "'. $data["flag"] .'" disabled></br>
    <input type = submit name = "savebutton" value = "Save">
</form>';

echo $stringForm;
