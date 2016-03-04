<?php
class ViewLogin extends View
{
    public function __construct()
    {
        $this->template = '<div class="container">
        <legend>Login page</legend>
          <form class="form-signin" role="form" action = "/User/Login" method = "post">
            <h2 class="form-signin-heading">Please sign in</h2>
                <div class="form-group">
                <input type="text" class="form-control" name = "userlogin" placeholder="Login" required autofocus>
                </div>
                <div class="form-group">
                <input type="password" class="form-control" name = "userpassword" placeholder="Password" required>
                </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name = "loginbutton">Sign in</button>
          </form>
        </div>';
    }
}
