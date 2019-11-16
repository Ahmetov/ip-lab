<?php
$date = $_POST["date"];
$imgPass = '../pics/';
$pass = '../news-posts/';

if (file_exists($pass . $date . '.json')) {
    unlink($pass . $date . '.json');
    if (file_exists($imgPass . $date . '.jpg')) {
        unlink($imgPass . $date . '.jpg');
    } else {
        echo 'img not found';
    }
    echo 'success';
} else {
    echo 'error';
}

