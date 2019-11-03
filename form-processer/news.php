<?php
require_once "../model/NewsPost.php";

processNews();

function processNews()
{
    $pass = './news-posts/';
    if (isset($_POST['short']) && isset($_POST['title']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $short = $_POST['short'];
        $content = $_POST['content'];

        $now = new DateTime();
        echo $now->format('Y-m-d H:i:s');    // MySQL datetime format

        $newsPost = new NewsPost($now->format('Y-m-d H-i-s'), $title, $short, $content);
        file_put_contents($pass . $now->format('Y-m-d H-i-s') . '.json', json_encode($newsPost, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);

        $files = scandir($pass);
        try {
            foreach ($files as $file) {
                if (endsWith($file, '.json')) {
                    $tmp = json_decode(file_get_contents($pass . $file), true);
                    //echo $tmp['title'];
                    print_r($tmp);
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

//        $shipments = json_decode(file_get_contents("shipments.js"), true);
//        print_r($shipments);
    }
    //header("Location: ../admin.php");
}

function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

?>
