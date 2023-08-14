<?php

// dbconnect.phpを読み込む ➞ DBに接続
include_once('./dbconnect.php');

// 新しいレコードを追加するための処理
// 【処理の流れ】
// 最終のゴール：新しい家計簿が追加されて、TOPに戻る

// 1. 画面で入力された値の取得
// 2. PHPからMySQLへ接続
// 3. SQL文を作成して、画面で入力された値をusersテーブルに追加
// 4. index.phpに画面遷移する

$user_name = $_POST['user_name'];

// INSERT文の作成
$sql = "INSERT INTO users(user_name) VALUES(:user_name)";

// 先程作成したSQLを実行できるよう準備
$stmt = $pdo->prepare($sql);

// 値の設定
$stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
// SQLを実行
$stmt->execute();

// index.phpに移動
header('Location: ./userTable.php');
exit;