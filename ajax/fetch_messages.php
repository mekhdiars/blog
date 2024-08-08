<?php
include_once '../lib/mysql.php';

$query = $pdo->query("SELECT * FROM chat ORDER BY id DESC");
$messages = $query->fetchAll(PDO::FETCH_OBJ);

if($messages != false) {
    foreach($messages as $el) {
        if ($el->name === $_COOKIE['log'])
            echo '<p class="my_mess">' . $el->mess . '<span class="name">Вы</span></p><br>';
        else
            echo '<p class="mess">' . $el->mess . '<span class="name">' . $el->name . '</span></p><br>';
    }
} else {
    echo '<p class="empty_chat">Чат пока пустой</p>';
}
?>