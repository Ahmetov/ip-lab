<?php
$pass = '../news-posts/';
$imgPass = '../pics/';
$files = scandir($pass);

$counter = 0;
$response = array();
try {
    foreach ($files as $file) {
        if (endsWith($file, '.json')) {
            $property = array();
            $tmp = json_decode(file_get_contents($pass . $file), true);

            $property["title"] = $tmp['title'];    //HEADER

            $property["short"] = $tmp['short'];    //SHORT

            $i = $imgPass . substr($file, 0, -5) . '.jpg';
            if (file_exists($i)) {
                $property["image"] = './pics/' . substr($file, 0, -5) . '.jpg';    //IMAGE
            }

            $property["content"] = $tmp['content'];

            $property["num"] = $counter;

            $response[$counter++] = $property;
        }
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    error_log($e->getMessage());
}

function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

?>
