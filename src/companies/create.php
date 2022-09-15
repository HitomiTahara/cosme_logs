<?php

//libファイルに入っているmysqliファイルを読み込む
require_once __DIR__ . '/lib/mysqli.php';

function createCompany($link, $company)
{
    $sql = <<<EOT
    INSERT INTO companies(
        name,
        establishment_date,
        founder
        )VALUES(
"{$company['name']}",
"{$company['establishment_date']}",
"{$company['founder']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'データを登録しました' . PHP_EOL;
    } else {
        echo 'Eroor:データ追加に失敗しました。' . PHP_EOL;
        echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    }
}

//HTTPメソッドがPOSTだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //POSTされた会社情報を変数に格納
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];


    //バリデーション

    //データベースに接続
    $link = dbConnect();

    //データベースにデータを登録する
    createCompany($link, $company);
    //データベースとの接続を切断
    mysqli_close($link);
}

//リダイレクト処理
header("location: index.php");
