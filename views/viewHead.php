<?php
class ViewHead extends View
{
    public function __construct()
    {
        $this->template = '<meta charset="utf-8">
        <title>Link storage</title>
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
        <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>';
    }
}


