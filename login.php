<?php
$login='';
$psw='';

if (isset($_POST['login']) && !empty($_POST['uname']) && !empty($_POST['psw'])) {
    $login=$_POST['uname'];
    $psw=$_POST['psw'];
    if ($login == 'admin' &&
        $psw == 'admin' &&
        $_POST['uname'] == $login &&
        $_POST['psw'] == $psw) {
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['uname'] = $login;
        $_SESSION['psw'] = $psw;
        header("Location: admin.php");
        echo 'You have entered valid use name and password';
    }else {
        header("Location: index.php");
        exit;
    }
}
?>