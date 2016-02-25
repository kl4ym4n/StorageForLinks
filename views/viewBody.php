<?php
class ViewBody extends View
{
    public $header, $content, $footer;
    public function __construct()
    {
        $this->template = '<!DOCTYPE html>
                          <div class = "header"> %s </div>
                          <div class = "content"> %s </div>
                          <div class = "footer"> %s </div>';

        $this->header = new ViewHeader();
        $this->content = new ViewContent();
        $this->footer = new ViewFooter();

        $this->args = array($this->header, $this->content, $this->footer);
    }
}