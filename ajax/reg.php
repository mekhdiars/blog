<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($name) < 3)
    $error = 'Имя не менее 3 символов';
else if (strlen($email) < 7)
    $error = 'Email не менее 7 символов';
else if (strlen($password) < 4)
    $error = 'Пароль не менее 5 симвоов';

if ($error != '') {
    echo $error;
    exit();
}

$password = md5($password);

include_once '../lib/mysql.php'; // подключение к БД

$user = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$user->execute([':email' => $email]);
$userId = $user->fetch(PDO::FETCH_OBJ);

if (isset($userId->id)) {
    echo 'Пользователь с таким email уже существует'; 
    exit;
}

$query = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
$query->execute([':name' => $name, ':email' => $email, ':password' => $password]);

echo 'Done';