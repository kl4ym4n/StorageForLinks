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
                                     <li ';
                                            $this->template .= $this->echoActiveClass("/index");
                                            $this->template .= '><a href = "/index">Home</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("PublicLinks");
                                            $this->template .= '><a href="/Link/PublicLinks/?page=0">Public Links</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("AllUsers");
                                            $this->template .= '><a href="/User/AllUsers/?page=0">Users</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("AddLinkPage");
                                            $this->template .= '><a href="/Link/AddLinkPage">Add Link</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("UserLinks");
                                            $this->template .= '><a href="/Link/UserLinks/?page=0">My Links</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("AllLinks");
                                            $this->template .= '><a href="/Link/AllLinks/?page=0">All links</a></li>

                                     <li ';
                                            $this->template .= $this->echoActiveClass("ViewProfile");
                                            $this->template .= '><a href="/User/ViewProfile">My Profile</a></li>
                                     </ul>';
                                     if (isset($_SESSION['userID']))
                                     {
                                         $this->template .= '<div class="nav navbar-nav navbar-right">
                                                            <button id="logout" class="btn btn-default navbar-btn">Logout</button>
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

