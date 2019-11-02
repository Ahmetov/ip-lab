<?php

require_once "../model/NewsPost.php";
processNews();

function processNews()
{
    if (isset($_POST['short']) && isset($_POST['title']) && isset($_POST['content'])) {
        static $counter = 0;
        $title = $_POST['title'];
        $short = $_POST['short'];
        $content = $_POST['content'];

        $newsPost = new NewsPost($counter, $title, $short, $content);
        $_ENV[$counter++] = $newsPost;
    }
    print_r($_ENV);
    //header("Location: ../admin.php");
}

?>
