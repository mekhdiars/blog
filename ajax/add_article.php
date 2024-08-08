<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'], FILTER_SANITIZE_SPECIAL_CHARS));
$fullText = trim(filter_var($_POST['full_text'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($title) < 5)
    $error = 'Название статьи не менее 5 символов';
else if (strlen($anons) < 10)
    $error = 'Анонс не менее 10 символов';
else if (strlen($fullText) < 10)
    $error = 'Основной текст не менее 10 символов';

if ($error != '') {
    echo $error;
    exit();
}

include_once '../lib/mysql.php'; // подключение к БД

$query = $pdo->prepare("INSERT INTO articles (title, anons, full_text, date, avtor) VALUES (:title, :anons, :full_text, :date, :avtor)");
$query->execute([':title' => $title, ':anons' => $anons, ':full_text' => $fullText, ':date' => time(), ':avtor' => $_COOKIE['log']]);

echo 'Done';