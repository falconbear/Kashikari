<?php

include_once('./dbconnect.php');
include_once('./functions.php');

// 選択されたIDを取得
$id = $_GET['id'];

// 1. DB接続
// 2. 編集するデータを取得
// 3. 取得したデータを表示

// SQL作成
$sql = "SELECT
	records.id AS id,
  lenders.user_name AS lender,
  records.lender_id AS lender_id,
  borrowers.user_name AS borrower,
  records.borrower_id AS borrower_id,
  records.title,
  records.amount,
  records.date,
  records.created_at,
  records.updated_at
FROM records
LEFT JOIN users AS lenders
  ON records.lender_id = lenders.user_id
LEFT JOIN users AS  borrowers
  ON records.borrower_id = borrowers.user_id
WHERE id = :id";
// SQL実行準備
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
// SQLの実行
$stmt->execute();
// 実行結果の取得
$record = $stmt->fetch();

// usersのSQL文を作成
$sql_users = "SELECT * FROM users";
// SQLの実行準備
$stmt_users = $pdo->prepare($sql_users);
// SQLの実行
$stmt_users->execute();
// 全データを変数に入れる
$users = $stmt_users->fetchAll();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>かけいぼ</title>
</head>
<body>

  <div class="container">
    <header class="mb-5">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">ホーム</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </header>

    <form class="m-5" action="./update.php" method="POST">
      <input type="hidden" name="id" value="<?= $id; ?>">
      <p class="alert alert-success" role="alert">編集フォーム</p>
      <div class="form-group">
        <label for="date">日付</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= h($record['date']); ?>">
      </div>
      <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= h($record['title']); ?>">
      </div>
      <div class="form-group">
        <label for="amount">金額</label>
        <input type="number" class="form-control" id="amount" name="amount" value="<?= h($record['amount']); ?>">
      </div>
      <div class="form-group">
        <label for="lender">貸した人</label>
        <select name="lender" id="lender">
          <option value="<?php echo h($record['lender_id']); ?>" hidden><?= h($record['lender']); ?></option>
          <?php foreach($users as $user): ?>
            <option value="<?php echo h($user['user_id']); ?>"><?php echo h($user['user_name']); ?></option>
          <?php endforeach; ?>
        </select>
        <label for="borrower">借りた人</label>
        <select name="borrower" id="borrower">
        <option value="<?php echo h($record['borrower_id']); ?>" hidden><?= h($record['borrower']); ?></option>
          <?php foreach($users as $user): ?>
            <option value="<?php echo h($user['user_id']); ?>"><?php echo h($user['user_name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">編集</button>
      </div>
    </form>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>
</html>