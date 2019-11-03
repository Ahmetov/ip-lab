<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judo news</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        body {
            background: #000 url(static/img/judo.jpg);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        .judo-navbar {
            background-color: rgba(33, 33, 33, 0.96) !important;
            color: white !important;
        }

        .news-post {
            padding-top: 2%;
            margin: 2% 2% 0 2%;
            height: 515px;
            width: 96%;
            background-color: rgba(33, 33, 33, 0.99);
            border-radius: 3px;
            overflow-y: auto;
        }

        .news-post p {
            margin: 2% 2% 0 2%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark judo-navbar">
    <a class="navbar-brand" href="#">Judo world news</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="background-color: darkred" href="./logout.php">Log out</a>
            </li>
        </ul>
    </div>
</nav>

<?php
$pass = './news-posts/';
$files = scandir($pass);
try {
    foreach ($files as $file) {
        if (endsWith($file, '.json')) {
            $tmp = json_decode(file_get_contents($pass . $file), true);
            echo("<div class=\"news-post\">");
            echo("<h1 class=\"text-white text-center\">");
            echo($tmp['title']);
            echo("</h1>");

            echo("<h3 class=\"text-white text-center\">");
            echo($tmp['short']);
            echo("</h3>");

            echo("<p class=\"text-white\">");
            echo($tmp['content']);
            echo("</p>");
            echo("</div>");
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
}

function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

?>

<div class="news-post">
    <h1 class="text-white text-center">ЕЕЕ</h1>
    <h3 class="text-white text-center"></h3>
    <p class="text-white">asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>asdsd<br>
    </p>
</div>

<div class="news-post">

</div>

<?php
print_r($_ENV);
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
