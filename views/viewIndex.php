<?php
class ViewIndex extends View
{
   public $head, $body;
   public function __construct()
   {
      $this->template = '<!DOCTYPE html>
                          <head> %s </head>
                          <body> %s </body>';

      $this->head = new ViewHead();
      $this->body = new ViewBody();
      $this->args = array($this->head, $this->body);
       //$srcDir = __DIR__ ;
       //var_dump($srcDir);
   }
}
