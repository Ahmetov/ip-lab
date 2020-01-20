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
            overflow-wrap: break-word;
        }

        .news-post p {
            margin: 2% 2% 0 2%;
        }

        .news-post img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        body {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 18px;
            background-color: #CCC;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark judo-navbar">
    <a class="navbar-brand" href="news-board.php">Judo world news</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Add news<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">News editor<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="background-color: darkred" href="./logout.php">Log out</a>
            </li>
        </ul>
    </div>
</nav>

<button class="btn btn-info" onclick="onSort()">
    Сортировать по заголовку
</button>

<div id="news-container">

</div>

<script type="text/javascript">
    let newsData;
    //FIRST TIME DATA RECEIVED
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

    //DELETE
    function dynamicDelete(date) {
        $.ajax({
            url: "static/delete-news.php",
            type: "POST",
            data: {date: date},
            success: function (data) {
                removeAllChildNodes();
                for (let news of newsData) {
                    if (news["date"] === date) {
                        newsData.splice(newsData.findIndex(i => i.date === date), 1);
                        break;
                    }
                }
                updateNewsBoard(newsData);
            }
        });
    }

    function updateNewsBoard(newsData) {
        let container = document.getElementById('news-container');
        for (let item of newsData) {
            let innerContainer = document.createElement('div');
            innerContainer.className = 'news-post';
            generateHeader(innerContainer, item);
            generateShort(innerContainer, item);
            generateImg(innerContainer, item);
            generateContent(innerContainer, item);
            generateDate(innerContainer, item);
            container.appendChild(innerContainer);

            let delButton = document.createElement('button');
            delButton.className = 'btn btn-danger text-white';
            delButton.innerHTML = 'Remove';
            delButton.setAttribute('onclick', 'dynamicDelete(\'' + item["date"] + '\')');
            container.appendChild(delButton);

            let updateButton = document.createElement('a');
            updateButton.className = 'btn btn-warning text-white';
            updateButton.innerHTML = 'Update';
            updateButton.setAttribute('href', 'update-news.php?id=' + item["date"]);
            container.appendChild(updateButton);
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

    function generateContent(container, item) {
        let shortTag = document.createElement('p');
        shortTag.innerHTML = item["content"];
        shortTag.className = "text-white text-center";
        container.appendChild(shortTag);
    }

    function generateDate(container, item) {
        let shortTag = document.createElement('span');
        shortTag.innerHTML = item["date"];
        shortTag.className = "text-white";
        container.appendChild(shortTag);
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