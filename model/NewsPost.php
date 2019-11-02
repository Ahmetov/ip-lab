<?php

class NewsPost
{
    public static $counter = 0;

    public $id;
    public $title;
    public $short;
    public $content;

    function __construct($id, $title, $short, $content)
    {
        self::$counter++;
        $this->content = $content;
        $this->short = $short;
        $this->title = $title;
        $this->id = $id;
    }
}

?>