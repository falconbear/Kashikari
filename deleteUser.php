<?php

include_once('./dbconnect.php');

$user_id = $_GET['user_id'];

// DB接続
// DELETEのSQLを準備
// SQLを実行
// TOPに移動

$sql = 'DELETE FROM users WHERE user_id = :user_id';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$stmt->execute();

header('Location: ./userTable.php');
exit;