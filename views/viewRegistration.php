<?php
class viewRegistration extends View
{
        public function __construct()
        {
                $this->template = '<div class="container">
                <form class= "form-horizontal" method = post action="Registration">

                <fieldset>

                <legend>Registration</legend>

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
                    <label class="control-label">Repeat password</label>
                        <div class="controls">
                        <input type="password" name = "repassword" value ="" required>
                        </div>
                </div>

                <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                <button type="submit" class="btn btn-primary" name = "regbutton">Create My Account</button>
                </div>
                </div>

                </fieldset>
                </form>';

        }
}

