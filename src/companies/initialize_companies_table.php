<?php

require __DIR__ . '/../vendor/autoload.php';

function dbConnect()
{
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
  $dotenv->load();

  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
  if (!$link) {
    echo 'Error:データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  return $link;
}

function dropTable($link)
{
  $dropTableSql = 'DROP TABLE IF EXISTS companies;';
  $result = mysqli_query($link, $dropTableSql);
  if ($result) {
    echo 'テーブルを削除しました' . PHP_EOL;
  } else {
    echo 'Error:テーブルの削除に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
  }
}


function createTable($link)
{
  $createTableSql = <<<EOT
  CREATE TABLE companies (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  establishment_date DATE,
  founder VARCHAR(255),
  create_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET =utf8mb4;
EOT;

  $result = mysqli_query($link, $createTableSql);
  if ($result) {
    echo 'テーブルを作成しました' . PHP_EOL;
  } else {
    echo 'Error:テーブルの作成に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
  }
}

//接続
$link = dbConnect();

//テーブル削除
dropTable($link);

//テーブル作成
createTable($link);

//切断
mysqli_close($link);
