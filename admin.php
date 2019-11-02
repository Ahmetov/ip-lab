<?php
session_start();
if (isset($_SESSION['uname']) && isset($_SESSION['psw'])) {
    include 'static/admin.php';
} else {
    header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
    die('Недостаточно прав для совершения операции');
}
?>

