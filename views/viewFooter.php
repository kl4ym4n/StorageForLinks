<?php
class ViewFooter extends View
{
    public function __construct()
    {
        $this->template = '<div class = "navbar navbar-default navbar-fixed-bottom">
                                <div class = "container">
                                    <p class = "navbar-text">Site footer</p>
                                </div>
                           </div>';
    }
}
