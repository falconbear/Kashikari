<?php

// DBへの接続
include_once('./dbconnect.php');

// functions.phpを読み込む
include_once('./functions.php');

// 処理の流れ
// 1. DBへの接続
// 2. recordsテーブルのデータを全件取得
// 3. 全データを画面に表示


// SQL文を作成
$sql = "SELECT * FROM users";

// SQLの実行準備
$stmt = $pdo->prepare($sql);

// SQLの実行
$stmt->execute();

// 全データを変数に入れる
$users = $stmt->fetchAll();

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
        <a class="navbar-brand" href="index.php">かけいぼ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </header>

    <form class="m-5" action="./create.php" method="POST">
      <p class="alert alert-primary" role="alert">新規追加フォーム</p>
      <div class="form-group">
        <label for="date">日付</label>
        <input type="date" class="form-control" id="date" name="date">
      </div>
      <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="amount">金額</label>
        <input type="number" class="form-control" id="amount" name="amount">
      </div>
      <div class="form-group">
        <label for="lender">貸した人</label>
        <select name="lender" id="lender">
          <?php foreach($users as $user): ?>
            <option value="<?php echo h($user['user_id']); ?>"><?php echo h($user['user_name']); ?></option>
          <?php endforeach; ?>
        </select>
        <label for="borrower">借りた人</label>
        <select name="borrower" id="borrower">
          <?php foreach($users as $user): ?>
            <option value="<?php echo h($user['user_id']); ?>"><?php echo h($user['user_name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">追加</button>
      </div>
    </form>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>
</html>