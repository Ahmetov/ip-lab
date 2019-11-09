<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judo news</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

        .news-post img {
            display: block;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark judo-navbar">
    <a class="navbar-brand" href="#">Judo world news</a>
</nav>

<button class="btn btn-info" onclick="onSort()">
    Сортировать по заголовку
</button>

<div id="news-container">

</div>

<script type="text/javascript">
    let newsData;
    $("document").ready(function () {
        $.ajax({
            url: "static/load-news.php",
            type: "GET",
            success: function (data) {
                newsData = jQuery.parseJSON(data);
                updateNewsBoard(newsData);
            }
        });
    });

    function updateNewsBoard(newsData) {
        let container = document.getElementById('news-container');
        for (let item of newsData) {
            let innerContainer = document.createElement('div');
            innerContainer.className = 'news-post';
            generateHeader(innerContainer, item);
            generateShort(innerContainer, item);
            generateImg(innerContainer, item);
            container.appendChild(innerContainer);
        }
    }

    function generateHeader(container, item) {
        let headerTag = document.createElement('h1');
        headerTag.innerHTML = item["title"];
        headerTag.className = "text-white text-center";
        container.appendChild(headerTag);
    }

    function generateShort(container, item) {
        let shortTag = document.createElement('h3');
        shortTag.innerHTML = item["short"];
        shortTag.className = "text-white text-center";
        container.appendChild(shortTag);
    }

    function generateImg(container, item) {
        if (item["image"]) {
            let imageTag = document.createElement('img');
            imageTag.setAttribute("src", item["image"]);
            container.appendChild(imageTag);
        }
    }

    function removeAllChildNodes() {
        let element = document.getElementById('news-container');
        let child = element.lastElementChild;
        while (child) {
            element.removeChild(child);
            child = element.lastElementChild;
        }
    }

    function onSort() {
        removeAllChildNodes();
        newsData.sort((a, b) => a.num < b.num ? 1 : -1);
        updateNewsBoard(newsData);
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
