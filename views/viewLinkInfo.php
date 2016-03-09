<?php
class ViewLinkInfo extends View
{
    public function __construct($data)
    {
        $checkedFlag = '';
        if ($data["flag"] == '0')
        {
            $checkedFlag = 'Public';
        }
        else
        {
            $checkedFlag = 'Private';
        }
        //echo $data["flag"];
        $this->template = '<div class="container">

                            <fieldset>

                            <legend>View link info</legend>

                            <div class="control-group">
                                <label class="control-label">Link title:</label>
                                    <span class="inline">'.$data['header'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link:</label>
                                    <span class="inline">'.$data['link'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Description:</label>
                                    <span class="inline">'.$data['description'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link status:</label>
                                    <span class="inline">'.$checkedFlag.'</span>
                            </div>

                            </fieldset>

                            <div class="control-group">
                            <label class="control-label"></label>
                                <div class="controls">
                                <a href="/Link/ViewEditLink/?linkid='.$data["id"].'" class="btn btn-primary">Edit link</a>
                                <button class="btn btn-primary" name = "deletelinkbutton">Delete link</button>
                                </div>
                            </div>';
    }
}

//
//$stringForm = '<form method = post action = "ViewLink">
//    Header: <input type = text name = "linkheader" value = "'. $data["header"] .'" disabled></br>
//    Link: <input type = text name = "userlink" value = "'. $data["link"] .'" disabled></br>
//    Description: <textarea rows="10" cols="75" name="linkdescription" disabled>' .$data["description"].
//    '</textarea></br>
//    Private: <input type = checkbox name = "linkflag" value = "'. $data["flag"] .'" disabled></br>
//    <input type = submit name = "savebutton" value = "Save">
//</form>';

