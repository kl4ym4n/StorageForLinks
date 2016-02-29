<?php
class ViewEditLink extends View
{
    public function __construct()
    {
        $this->template = '<div class="container">
                            <form class= "form-horizontal" method = post action="EditLink">

                            <fieldset>

                            <legend>Edit link</legend>

                            <div class="control-group">
                                <label class="control-label">Link title</label>
                                    <div class="controls">
                                    <input type="text" name = "linkheader" value ="" required autofocus>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link</label>
                                    <div class="controls">
                                    <input type="text" name = "userlink" value ="" required>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Description</label>
                                    <div class="controls">
                                    <textarea class="form-control" rows="5" name="linkdescription"></textarea>
                                    </div>
                            </div>

                            <div class="checkbox">
                                <input type="hidden" name="linkflag" value="0" />
                                <label><input type="checkbox" name = "linkflag" value = "1">Set private</label>
                            </div>

                            <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                            <button type="submit" class="btn btn-primary" name = "savelinkbutton">Save</button>
                            </div>
                            </div>

                            </fieldset>
                            </form>';
    }
}

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
