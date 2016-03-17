<?php
class ViewEditUserProfile extends View
{
    public function __construct($data)
    {
        $checkedFlag = '';
        if ($data["status"] == '0')
        {
            $checkedFlag = '';
        }
        else
        {
            $checkedFlag = 'checked';
        }
        $this->template = '<div class="container">
                <form class= "form-horizontal" method = post action="/User/UpdateProfile/?userid='.$data["id"].'">

                <fieldset>

                <legend>Edit profile</legend>

                <div class="control-group">
                    <label class="control-label">Login</label>
                        <div class="controls">
                        <input type="text" name = "login" value ="'.$data['login'].'" required disabled>
                        </div>
                </div>


                <div class="control-group">
                    <label class="control-label">Mail</label>
                        <div class="controls">
                        <input type="text" name = "mail" value ="'.$data['email'].'" required autofocus>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Name</label>
                        <div class="controls">
                        <input type="text" name = "username" value ="'.$data['name'].'" required>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Surname</label>
                        <div class="controls">
                        <input type="text" name = "surname" value ="'.$data['surname'].'" required>
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
                          <select class="form-control" id="selectRole">';
                            foreach ($data['roleList'] as $row)
                            {
                                $this->template .= '<option>' . $row['role'] . '</option>';
                            }
        $this->template .= '
                          </select>

                    </div>
                </div>

                <div class="checkbox">
                      <input type="hidden" name="statusflag" value="0" />
                      <label><input type="checkbox" name = "statusflag" value = "1" '.$checkedFlag.'>Set status active</label>
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

//<div class="control-group">
//                    <label class="control-label">Role</label>
//                        <div class="controls">
//                        <input type="text" name = "role" value ="'.$data['role'][0].'" required>
//                        </div>
//                </div>