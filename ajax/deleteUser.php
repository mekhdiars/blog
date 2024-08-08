<?php
echo '<pre>' . print_r($_POST, true) . '</pre>';
$id = $_POST['id'];
include_once '../lib/mysql.php';
$query = $pdo->query("DELETE FROM users WHERE id = $id");