<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($name) < 3)
    $error = 'Имя не менее 3 символов';
else if (mb_strlen($email) < 10)
    $error = 'Email не менее 10 символов';
else if (mb_strlen($mess) < 5)
    $error = 'Сообщение не менее 5 символов';

if ($error != '') {
    echo $error;
    exit();
}

$to = "mekhdi@mail.ru";
$subject = "=?utf-8?B?" . base64_encode('Zdarov!') . "?=";
$message = "Пользователь: $name.<br>$mess";
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

mail($to, $subject, $message, $headers);

echo 'Done';