<?php
class ViewUserProfile extends View
{
    public function __construct($data)
    {
        if ($data["status"] == '0')
        {
            $checkedFlag = 'inactive';
        }
        else
        {
            $checkedFlag = 'active';
        }
        $this->template = '<div class="container">


                <fieldset>

                <legend>View profile</legend>

                <div class="control-group">
                    <label class="control-label">Login:</label>
                        <span class="inline">'.$data['login'].'</span>
                </div>

                <div class="control-group">
                    <label class="control-label">Mail:</label>
                        <span class="inline">'.$data['email'].'</span>
                </div>

                <div class="control-group">
                    <label class="control-label">Name:</label>
                        <span class="inline">'.$data['name'].'</span>
                </div>

                <div class="control-group">
                    <label class="control-label">Surname:</label>
                        <span class="inline">'.$data['surname'].'</span>
                </div>

                <div class="control-group">
                    <label class="control-label">Role:</label>
                        <span class="inline">'.$data['role'][0].'</span>
                </div>

                <div class="control-group">
                    <label class="control-label">Status:</label>
                        <span class="inline">'.$checkedFlag.'</span>
                </div>

                <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                <a href="/User/EditProfile/?userid='.$data["id"].'" class="btn btn-primary">Edit Profile</a>
                </div>
                </div>

                </fieldset>';
    }
}