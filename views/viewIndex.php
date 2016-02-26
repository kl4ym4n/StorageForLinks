<?php
class ViewIndex extends View
{
   public $head, $body;
   public function __construct($contentView)
   {
      $this->template = '<!DOCTYPE html>
                          <head> %s </head>
                          <body> %s </body>';

      $this->head = new ViewHead();
      $this->body = new ViewBody($contentView);
      $this->args = array($this->head, $this->body);
   }
}
