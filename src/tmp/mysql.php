<?php
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

if (!$link) {
    echo 'Error:データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo 'データベースに接続できました' . PHP_EOL;

$sql = <<<EOT
INSERT INTO cosmelog (
product_name,
product_maker,
use_by_date,
suggestion,
etc
)VALUES(
'mascara',
'KOSE',
'2023-09-13',
'2',
'bad'
)
EOT;

$result = mysqli_query($link, $sql);

if ($result) {
    echo 'データを追加しました' . PHP_EOL;
} else {
    echo 'Error:データ追加に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
}
// mysqli_query($link, $sql);


// mysqli_query($link, $sql);

mysqli_close($link);
echo 'データベースとの接続を切断しました' . PHP_EOL;
