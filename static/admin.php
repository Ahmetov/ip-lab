<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judo news</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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

        .group-add {
            padding-top: 2%;
            margin:2% 10% 0 10%;
            height: 515px;
            width:80%;
            background-color: rgba(33, 33, 33, 0.86);
            border-radius: 3px;
        }

        .add-form {
            margin:0 25% 0 25%;
            width:50%;
            color: white;
            /*background-color: black;*/
        }
        .noresize {
            resize: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark judo-navbar">
<a class="navbar-brand" href="#">Judo world news</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

<div class="group-add">
<div class="add-form">
    <form action="./form-processer/news.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Заголовок новости</label>
        <input class="form-control" id="title" name="title" placeholder="Заголовок новости">
    </div>
    <div class="form-group">
        <label for="short">Кратко</label>
        <textarea class="form-control noresize" id="short" name="short" placeholder="Краткое содержание"
                  rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="content">Содержание</label>
        <textarea class="form-control noresize" id="content" name="content" placeholder="Текст новости"
                  rows="6"></textarea>
    </div>
        <div class="form-group">
            <input type="file" name="picture">
        </div>
        <button type="submit" class="btn btn-dark">Создать</button>
</form>
</div>
</div>

<?php

?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>