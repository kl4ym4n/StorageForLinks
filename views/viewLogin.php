<h1>Login page</h1>

<form method = post action = "Login">

    Login: <input type = text name = "userlogin" value = ""></br>
    Password: <input type = password name = "userpassword" value = ""></br>
    <input type = submit name = "loginbutton" value = "Enter!">
    <input type = submit name = "linkbutton" value = "Get link">
</form>

<a href= /Link/AddLinkPage >Add link</a>

<?php
class ViewLogin extends View
{
    protected  $content;
    public function __construct()
    {
        $this->content = '<div class="container">

      <form class="form-signin" role="form" action = "Login" method = "post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" name = "userlogin" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" name = "userpassword" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name = "loginbutton">Sign in</button>
      </form>

    </div>';
    }

    public function getContent()
    {
        return $this->content;
    }
}
