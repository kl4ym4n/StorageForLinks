<?php
class ViewBody extends View
{
    public $header, $content, $footer;
    public function __construct($contentView, $data)
    {
        $this->template = ' <div class = "header"> %s </div>
                            <div class = "content"> %s </div>
                            <div class = "footer"> %s </div>';

        $this->header = new ViewHeader();
        //echo $data[0]['header'];
        $this->content = new ViewContent($contentView, $data);
        $this->footer = new ViewFooter();

        $this->args = array($this->header, $this->content, $this->footer);
    }
}