<?php

//libファイルに入っているmysqliファイルを読み込む

require_once __DIR__ . '/lib/mysqli.php';

function createCosme($link, $cosme)
{
  $sql = <<<EOT
  INSERT INTO cosmelog (
    product_name,
    product_maker,
    use_by_date,
suggestion,
etc
)VALUES(
"{$cosme['product-name']}",
"{$cosme['product-maker']}",
"{$cosme['use-by-date']}",
"{$cosme['suggestion']}",
"{$cosme['etc']}"
)
EOT;

  // var_dump($cosme[$sql]);
  var_dump($cosme['use-by-date']);
  var_dump($cosme['suggestion']);

  $result = mysqli_query($link, $sql);
  if (!$result) {
    echo 'Error:データ追加に失敗しました。' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    error_log('Error: fail to create review');
    error_log('Debugging Error: ' . mysqli_error($link));
  }
}


//HTTPメソッドがPOSTだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cosme = [
    'product-name' => $_POST['product-name'],
    'product-maker' => $_POST['product-maker'],
    'use-by-date' => $_POST['use-by-date'],
    'suggestion' => $_POST['suggestion'],
    'etc' => $_POST['etc'],
  ];


  //バリデーション
  $link = dbConnect();
  createCosme($link, $cosme);
  mysqli_close($link);

  // //データベースに接続
  // $link = dbConnect();
  // //データベースにデータを登録する

  // createCosme($link, $cosme);

  // //データベースとの接続を切断
  // mysqli_close($link);

}

//リダイレクト処理

// header("location: index.php");
