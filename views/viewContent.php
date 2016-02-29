<?php
class ViewContent extends View
{
    public function __construct($contentView)
    {
        $className = 'view' . $contentView;
        $classView = new $className;
        $this->template = $classView->template;
    }
}
