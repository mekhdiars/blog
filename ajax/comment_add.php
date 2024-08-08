<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));
$id = $_POST['id'];

$error = '';
if (mb_strlen($name) < 3)
    $error = 'Имя не менее 3 символов';

if ($error != '') {
    echo $error;
    exit();
}

include_once '../lib/mysql.php'; // подключение к БД

$query = $pdo->prepare("INSERT INTO comments (name, mess, article_id) VALUES (:name, :mess, :article_id)");
$query->execute([':name' => $name, ':mess' => $mess, ':article_id' => $id]);

echo 'Done';