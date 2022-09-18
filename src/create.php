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

  $result = mysqli_query($link, $sql);
  if (!$result) {
    error_log('Error: fail to create review');
    error_log('Debugging Error: ' . mysqli_error($link));
  }
}

function validate($cosme)
{

  $errors = [];

  //化粧品名
  if (!strlen($cosme['product-name'])) {
    $errors['product-name'] = '化粧品名を入れてください';
  } elseif (strlen($cosme['product-name']) > 255) {
    $errors['product-name'] = '化粧品名を255文字以内で入れてください';
  }
  //メーカー名
  if (!strlen($cosme['product-maker'])) {
    $errors['product-maker'] = 'メーカー名を入れてください';
  } elseif (strlen($cosme['product-maker']) > 100) {
    $errors['product-maker'] = 'メーカー名を100文字以内で入れてください';
  }


  //使用期限
  /*自分で書いたコードはコメントアウト
  * if (!strlen($cosme['use-by-date'])) {
  *   $errors['use-by-date'] = '使用状況を選択してください';
 } else  */
  if (!in_array($cosme['use-by-date'], ['１年', '半年', '未使用'])) {
    $errors['use-by-date'] = '使用状況は「１年」「半年」「未使用」のいずれかを入力してください';
  }
  //おすすめ度

  if (($cosme['suggestion']) < 1 || ($cosme['suggestion']) > 10) {
    $errors['suggestion'] = ' おすすめ度は１~10の整数を入力してください';
  }
  //備考
  if (!strlen($cosme['etc'])) {
    $errors['etc'] = '備考を入れてください';
  } elseif (strlen($cosme['etc']) > 255) {
    $errors['etc'] = '備考は255文字以内で入力してください';
  }

  return $errors;
}

//HTTPメソッドがPOSTだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $use_by_date = '';
  if (array_key_exists('use-by-date', $_POST)) {
    $use_by_date = $_POST['use-by-date'];
  }

  $cosme = [
    'product-name' => $_POST['product-name'],
    'product-maker' => $_POST['product-maker'],
    'use-by-date' => $use_by_date,
    'suggestion' => $_POST['suggestion'],
    'etc' => $_POST['etc'],
  ];

  //バリデーション
  // バリデーションする
  $errors = validate($cosme);

  if (!count($errors)) {
    $link = dbConnect();
    createCosme($link, $cosme);
    mysqli_close($link);

    // //データベースに接続
    $link = dbConnect();
    // //データベースにデータを登録する
    createCosme($link, $cosme);
    // //データベースとの接続を切断
    mysqli_close($link);
    //リダイレクト処理
    header("location: index.php");
  }
}
include 'views/new.php';
