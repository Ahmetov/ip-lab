<?php
require_once "../model/NewsPost.php";


processNews();
function processNews()
{
    $filePath = $_FILES['picture']['tmp_name'];
    $errorCode = $_FILES['picture']['error'];
    $now = new DateTime();
    // Перезапишем переменные для удобства

// Проверим на ошибки

    $pass = '../news-posts/';
    if (isset($_POST['short']) && isset($_POST['title']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $short = $_POST['short'];
        $content = $_POST['content'];
        echo $now->format('Y-m-d H:i:s');    // MySQL datetime format

        $newsPost = new NewsPost($now->format('Y-m-d H-i-s'), $title, $short, $content);
        file_put_contents($pass . $now->format('Y-m-d H-i-s') . '.json', json_encode($newsPost, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);

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
            header("Location: ../admin.php");
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Закроем ресурс
        finfo_close($fi);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) header("Location: ../admin.php");

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * 5;
        $limitWidth = 1280;
        $limitHeight = 768;

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($filePath);

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);
        if (!move_uploaded_file($filePath, '../pics/' . $now->format('Y-m-d H-i-s') . $format)) {
            header("Location: ../admin.php");
        }
    }
    header("Location: ../admin.php");
}

?>
