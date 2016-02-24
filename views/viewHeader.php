<?php
class ViewHeader extends View
{
    public function __construct()
    {
        $this->template = '<div class="navbar navbar-default">
                              <div class="container">
                                <div class="navbar-header">
                                <a class="navbar-brand" href="#">Link Storage</a>
                                </div>
                                 <ul class="nav navbar-nav">
                                 <li class="active"><a href= index>Home</a></li>
                                 <li><a href="#">Public Links</a></li>
                                 </ul>

                            <div class="nav navbar-nav navbar-right">
                                <a href="User/LoginPage" class="btn btn-default">Sign in</a>

                                <button type="button" class="btn btn-default navbar-btn">Registration</button>
                            </div>
                            </div>
                           </div>';
    }
}

