<?php
class ViewContent extends View
{
    public function __construct($contentView, $data)
    {
        $className = 'view' . $contentView;
        $classView = new $className($data);
        //$classView->data = $data;
        $this->template = $classView->template;
        //echo $data[0]['header'];

    }
}
