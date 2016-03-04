<?php
class ViewLinkInfo extends View
{
    public function __construct($data)
    {
        //echo $data["id"];
        $this->template = '<div class="container">
                            <form class= "form-horizontal" method = post action="ViewLink">

                            <fieldset>

                            <legend>View link info</legend>

                            <div class="control-group">
                                <label class="control-label">Link title</label>
                                    <div class="controls">
                                    <input type="text" name = "linkheader" value ="'. $data["header"] .'" required disabled>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link</label>
                                    <div class="controls">
                                    <input type="text" name = "userlink" value ="'. $data["link"] .'" required disabled>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Description</label>
                                    <div class="controls">
                                    <textarea class="form-control" rows="5" name="linkdescription" disabled>' .$data["description"]. '</textarea>
                                    </div>
                            </div>

                            <div class="checkbox">
                                <input type="hidden" name="linkflag" value="0" />
                                <label><input type="checkbox" name = "linkflag" value = "'. $data["flag"] .'" disabled>Set private</label>
                            </div>

                            </fieldset>
                            </form>

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

