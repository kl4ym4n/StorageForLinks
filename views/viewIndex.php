<?php
class MainView extends View
{
   public $head, $body;
   public function __construct()
   {
      $this->template = '<!DOCTYPE html>
                          <head> %s </head>
                          <body> %s </body>';

      $this->head = new ViewHead();
      $this->body = new ViewBody();
   }
}


