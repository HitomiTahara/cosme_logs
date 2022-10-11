<?php
require_once __DIR__ . "/../lib/mysqli.php";
require __DIR__ . '/../vendor/autoload.php';

function dropTable($link)
{
    $dropTableSql = 'DROP TABLE IF EXISTS cosmelog;';
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
CREATE TABLE cosmelog (
id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(255),
product_maker VARCHAR(255),
use_by_date  VARCHAR(255),
suggestion INTEGER(10),
etc VARCHAR(255),
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
