<?php
class ViewHeader extends View
{
    public function __construct()
    {
        $this->template = '<div class="navbar navbar-default">
                              <div class="container">
                                    <div class="navbar-header">
                                    <a class="navbar-brand" href = "/index">Link Storage</a>
                                    </div>
                                     <ul class="nav navbar-nav">
                                     <li class="active"><a href = "/index">Home</a></li>
                                     <li><a href="/Link/PublicLinks/?page=0">Public Links</a></li>
                                     <li><a href="/User/AllUsers/?page=0">Users</a></li>
                                     <li><a href="/Link/AddLinkPage">Add Link</a></li>
                                     <li><a href="#">My Links</a></li>
                                     <li><a href="#">All links</a></li>
                                     </ul>';
                                     if (isset($_SESSION['userID']))
                                     {
                                         $this->template .= '<div class="nav navbar-nav navbar-right">
                                                            <a href="/User/Logout/" class="btn btn-default navbar-btn">Logout</a>
                                                            </div>';
                                     }
                                     else if (!isset($_SESSION['userID']))
                                     {
                                         $this->template .= '<div class="nav navbar-nav navbar-right">
                                        <a href="/User/LoginPage" class="btn btn-default navbar-btn">Sign in</a>
                                        <a href="/User/RegistrationPage" class="btn btn-default navbar-btn">Registration</a>
                                        </div>';
                                     }
        $this->template .= '
                              </div>
                           </div>';
    }
}

