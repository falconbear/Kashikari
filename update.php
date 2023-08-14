<?php

include_once('./dbconnect.php');

// 【処理の流れ】
// 1. 画面で入力された値の取得
// 2. PHPからMySQLへ接続
// 3. SQL文を作成して、画面で入力された値でrecordsテーブルを更新
// 4. index.phpに画面遷移する

$date = $_POST['date'];
$title = $_POST['title'];
$amount = $_POST['amount'];
$lender_id = $_POST['lender'];
$borrower_id = $_POST['borrower'];
$id = $_POST['id'];

$sql = "UPDATE records SET lender_id = :lender_id, borrower_id = :borrower_id, title = :title, amount = :amount, date = :date, updated_at = now() WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':lender_id', $lender_id, PDO::PARAM_INT);
$stmt->bindParam(':borrower_id', $borrower_id, PDO::PARAM_INT);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$stmt->execute();

header('Location: ./index.php');
exit;