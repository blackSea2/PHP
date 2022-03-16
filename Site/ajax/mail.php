<?php
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

    $error = '';

    if(strlen($username <= 3)) {
        $error = 'Введите имя';
    }
    elseif(strlen($email <= 3)) {
        $error = 'Введите email';
    }
    elseif (strlen($mess <= 3)) {
        $error = 'Введите сообщение';
    }
    if($error != ''){
        echo $error;
        exit();
    }

    $my_email = 'www.sanek1996.ru@mail.ru';
    $subject = '=?utf-8?B?' . base64_encode('Новое сообщение с сайта') . '?=';
    $header = "From: $email\r\nReply-to: $email\r\nContent-type^ text/html; charset=utf-8\r\n";

    mail($my_email, $subject, $mess, $header);

    echo 'Готово';
