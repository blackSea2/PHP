<?php
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $error = '';

    if(strlen($username <= 3)) {
        $error = 'Введите имя';
    }
    elseif(strlen($email <= 3)) {
        $error = 'Введите email';
    }
    elseif (strlen($login <= 3)) {
        $error = 'Введите логин';
    }
    elseif (strlen($pass <= 3)) {
        $error = 'Введите пароль';
    }
    if($error != ''){
        echo $error;
        exit();
    }



    $hash = 'sdjfhoei456423763357289241387guibwoeijeiojrboi';
    $pass = md5($pass . $hash);

    require_once '../mySQLconnect.php';

    $sql = 'INSERT INTO users(name, email, login, pass) VALUES(?, ?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$username, $email, $login, $pass]);

    echo 'Готово';