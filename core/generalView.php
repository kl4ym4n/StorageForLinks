<?php
class View
{
    function generate($content_view, $template_view)
    {
        include 'views/'.$template_view;
    }
}