<?php

try {

  $pdo = new PDO(
    // 'mysql:dbname=simple-kakeibo;host=localhost;charset=utf8mb4',
    'mysql:dbname=tsuke-seisan;host=localhost;charset=utf8mb4',
    'root',
    'root',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );

} catch (PDOException $e) {

    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());

}