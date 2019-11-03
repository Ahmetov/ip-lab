<?php

class NewsPost
{
    public $date;
    public $title;
    public $short;
    public $content;

    function __construct($date, $title, $short, $content)
    {
        $this->content = $content;
        $this->short = $short;
        $this->title = $title;
        $this->date = $date;
    }
}

?>