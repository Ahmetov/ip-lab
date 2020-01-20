<?php
require_once "../model/NewsPost.php";
echo $_POST['id'];
echo $_POST['title'];
echo $_POST['short'];
echo $_POST['content'];

if (isset($_POST['id'])) {
    processNews();
}

function processNews()
{
    $pass = '../news-posts/';

    $filePath = $_FILES['picture']['tmp_name'];
    $errorCode = $_FILES['picture']['error'];


    // Перезапишем переменные для удобства

// Проверим на ошибки

    if (isset($_POST['short']) && isset($_POST['title']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $short = $_POST['short'];
        $content = $_POST['content'];

        $newsPost = new NewsPost($_POST['id'], $title, $short, $content);
        file_put_contents($pass . $_POST['id'] . '.json', json_encode($newsPost, JSON_UNESCAPED_UNICODE) . PHP_EOL);

        if (isset($filePath)) {
            if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

                // Массив с названиями ошибок
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                    UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                    UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                    UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                    UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                    UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
                ];

                // Зададим неизвестную ошибку
                $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

                // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

                // Выведем название ошибки
                header("Location: ../news-editor.php");
            }

            // Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);

            // Получим MIME-тип
            $mime = (string)finfo_file($fi, $filePath);

            // Закроем ресурс
            finfo_close($fi);

            // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
            if (strpos($mime, 'image') === false)
                header("Location: ../news-editor.php");

                // Результат функции запишем в переменную
                $image = getimagesize($filePath);

            // Зададим ограничения для картинок
            $limitBytes = 1024 * 1024 * 5;
            $limitWidth = 1280;
            $limitHeight = 768;

            // Сгенерируем новое имя файла на основе MD5-хеша
            $name = md5_file($filePath);

            // Сгенерируем расширение файла на основе типа картинки

            // Сократим .jpeg до .jpg
            if (!move_uploaded_file($filePath, '../pics/' . $_POST['id'] . '.jpg')) {
                header("Location: ../news-editor.php");
            }
        }
    }
    header("Location: ../news-editor.php");
}

?>
