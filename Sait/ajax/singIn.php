<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

$error = '';

$hash = 'sdjfhoei456423763357289241387guibwoeijeiojrboi';
$pass = md5($pass . $hash);

require_once '../mySQLconnect.php';

$sql = 'SELECT id FROM users WHERE login = ? && pass = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $pass]);

$user = $query -> fetch(PDO::FETCH_OBJ);

if($user -> id == 0){
    $error = 'Неверный логин/пароль';
    echo $error;
} else{
    setcookie('login', $login, time() + 3600 * 24 * 30, "/");
    echo 'Готово';
}