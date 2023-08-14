<?php

// DBへの接続
include_once('./dbconnect.php');

// functions.phpを読み込む
include_once('./functions.php');

// 処理の流れ
// 1. DBへの接続
// 2. recordsテーブルのデータを全件取得
// 3. 全データを画面に表示

// 今後実装
// ・空欄で入力された場合のリダイレクト
// ・アプリ名を”Kasikari”に決定！
// ・フォルダ名の変更
// ・アプリ名をWebバーに表示
// ・アプリ名をトップ画面に表示
//   └デザイン考案
//   └index.html、フォームのhtmlを変更
// ・不必要なフォルダ・ファイルを削除
//   └db以下

// SQL文を作成
$sql = "SELECT
	records.id,
  lenders.user_name AS lender,
  borrowers.user_name AS borrower,
  records.title,
  records.amount,
  records.date,
  records.created_at,
  records.updated_at
FROM records
LEFT JOIN users AS lenders
  ON records.lender_id = lenders.user_id
LEFT JOIN users AS  borrowers
  ON records.borrower_id = borrowers.user_id";

// SQLの実行準備
$stmt = $pdo->prepare($sql);

// SQLの実行
$stmt->execute();

// 全データを変数に入れる
$records = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>貸し借り台帳</title>
</head>
<body>

  <div class="container">
    <header class="mb-5">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">ホーム</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-md-auto" id="navbarNavDropdown">
          <ul class="navbar-nav ml-md-auto">
            <li class="nav-item active">
              <a class="nav-link" href="./userTable.php">ユーザー登録</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="./createForm.php">追加</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="row">
      <div class="col-12">

      <!-- <div class="table-responsive">
          <table class="table table-fixed">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="col-12">あ</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach($records as $record): ?>

                <tr>
                  <td class="col-12"><?php echo h($record['lender']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div> -->
        <div class="table-responsive">
          <table class="table table-fixed">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="col-3">借りた人  →  貸した人</th>
                <th scope="col" class="col-2">金額</th>
                <th scope="col" class="col-3">詳細</th>
                <th scope="col" class="col-2">日付</th>
                <th scope="col" class="col-2">操作</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach($records as $record): ?>

                <tr>
                  <td class="col-3"><?php echo h($record['lender']); ?>  →  <?php echo h($record['borrower']); ?></td>
                  <td class="col-2"><?php echo h($record['amount']); ?></td>
                  <td class="col-3"><?php echo h($record['title']); ?></td>
                  <td class="col-2"><?php echo h($record['date']); ?></td>
                  <td class="col-2">
                    <a href="./editForm.php?id=<?php echo h($record['id']); ?>" class="btn btn-success text-light">編集</a>
                    <a href="./delete.php?id=<?php echo h($record['id']); ?>" class="btn btn-danger text-light">削除</a>
                  </td>
                </tr>

              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>
</html>