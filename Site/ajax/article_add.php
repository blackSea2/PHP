<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
$text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));

$error = '';

if(strlen($title <= 3)) {
    $error = 'Введите название';
}
elseif(strlen($intro <= 10)) {
    $error = 'Введите интро';
}
elseif (strlen($text <= 20)) {
    $error = 'Введите текст';
}

if($error != ''){
    echo $error;
    exit();
}

require_once '../mySQLconnect.php';

$sql = 'INSERT INTO articles(title, intro, text, date, avtor) VALUES(?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $intro, $text, time(), $_COOKIE['login']]);

echo 'Готово';