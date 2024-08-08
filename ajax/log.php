<?php
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($email) < 7)
    $error = 'Email не менее 7 символов';
else if (strlen($password) < 4)
    $error = 'Пароль не менее 4 симвоов';

if ($error != '') {
    echo $error;
    exit();
}

include_once '../lib/mysql.php'; // подключение к БД

$stmtPass = $pdo->prepare('SELECT password FROM users WHERE email = ?');
$stmtPass->execute([$email]);
$pass = $stmtPass->fetch(PDO::FETCH_OBJ);

if (strlen($pass->password) > 30)
    $password = md5($password); // хеширование пароля

$query = $pdo->prepare("SELECT id FROM users WHERE email = :email AND password = :password");
$query->execute([':email' => $email, ':password' => $password]);

$stmtName = $pdo->prepare(("SELECT name FROM users WHERE email = :email"));
$stmtName->execute([':email' => $email]);
$name = $stmtName->fetch(PDO::FETCH_OBJ);
$name = $name->name;

if ($query->rowCount() === 0)
    echo 'Такого пользователя не существует';
else {
    setcookie('log', $name, time() + 3600, '/');
    echo 'Done';
}
    