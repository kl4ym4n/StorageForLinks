<?php
class ViewEditProfile extends View
{
    public function __construct()
    {
        $this->template = 'div class="container">
                <form class= "form-horizontal" method = post action="UpdateProfile">

                <fieldset>

                <legend>Edit profile</legend>

                <div class="control-group">
                    <label class="control-label">Login</label>
                        <div class="controls">
                        <input type="text" name = "login" value ="" required autofocus>
                        </div>
                </div>


                <div class="control-group">
                    <label class="control-label">Mail</label>
                        <div class="controls">
                        <input type="text" name = "mail" value ="" required>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Name</label>
                        <div class="controls">
                        <input type="text" name = "username" value ="" required>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Surname</label>
                        <div class="controls">
                        <input type="text" name = "surname" value ="" required>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Password</label>
                        <div class="controls">
                        <input type="password" name = "password" value ="" required>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Role</label>
                        <div class="controls">
                        <input type="password" name = "role" value ="" required>
                        </div>
                </div>


                <div class="checkbox">
                      <input type="hidden" name="statusflag" value="0" />
                      <label><input type="checkbox" name = "statusflag" value = "1">Set status active</label>
                </div>

                <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                <button type="submit" class="btn btn-primary" name = "savebutton">Save</button>
                </div>
                </div>

                </fieldset>
                </form>';
    }
}
$checkedFlag = '';
if ($data["status"] == '0')
{
    $checkedFlag = '';
}
else
{
    $checkedFlag = 'checked';
}
$stringForm = '<form method = post action = "UpdateProfile">

    Login: <input type = text name = "login" value = "'. $data["login"] .'" disabled> </br>
    Mail: <input type = text name = "mail" value = "'. $data["email"] .'"></br>
    Name: <input type = text name = "username" value = "'. $data["name"] .'"></br>
    Surname: <input type = text name = "surname" value = "'. $data["surname"] .'"></br>
    Password: <input type = password name = "password" value = ""></br>
    Role: <input type = text name = "role" value = ""></br>
             <input type="hidden" name="statusflag" value="0" />
    Status Active: <input type = checkbox name = "statusflag" value = "1" ' .$checkedFlag.' ></br>
    <input type = submit name = "savebutton " value = "Save">

</form>';

echo $stringForm;
