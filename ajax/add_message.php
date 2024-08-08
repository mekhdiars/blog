<?php
$name = $_COOKIE['log'];
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

if ($mess == false)
    exit();

include_once '../lib/mysql.php'; // подключение к БД

$query = $pdo->prepare("INSERT INTO chat (name, mess) VALUES (:name, :mess)");
$query->execute([':name' => $name, ':mess' => $mess]);

echo 'Done';