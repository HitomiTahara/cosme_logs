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
    echo 'Error:データ追加に失敗しました。' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
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
  // if (!strlen($cosme['use-by-date'])) {
  //   $errors['use-by-date'] = '使用状況を選択してください';
  // } else
  if (!in_array($cosme['use-by-date'], ['１年', '半年', '未使用'])) {
    $errors['use-by-date'] = '使用状況は「１年」「半年」「未使用」のいずれかを入力してください';
  }

  var_dump(in_array($cosme['use-by-date'], ['１年', '半年', '未読']));

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
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>コスメログ</title>
</head>

<body>
  <h1>化粧品の登録</h1>
  <form action="create.php" method="POST">
    <?php if (count($errors)) : ?>
      <ul>
        <?php foreach ($errors as $error) : ?>
          <li><?php echo $error; ?> </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <div>
      <label for="product-name">化粧品名</label>
      <input type="text" name="product-name" id="product-name">
    </div>

    <div>
      <label for="product-maker">メーカー名</label>
      <input type="text" name="product-maker" id="product-maker">
    </div>

    <div>
      <label>使用状況</label>
      <div>
        <div>
          <input type="radio" name="use-by-date" id="year" value="１年">
          <label for="year">１年</label>
        </div>
        <div>
          <input type="radio" name="use-by-date" id="half-year" value="半年">
          <label for="half-year">半年</label>
        </div>
        <div>
          <input type="radio" name="use-by-date" id="not-use" value="未使用">
          <label for="not-use">未使用</label>
        </div>
      </div>
    </div>

    <div>
      <label for="suggestion">おすすめ度（10満点の整数）</label>
      <input type="number" name="suggestion" id="suggestion">
    </div>

    <div>
      <label for="etc">備考</label>
      <textarea type="text" id="etc" name="etc" rows="10"></textarea>
    </div>


    <button type="submit">登録する</button>
  </form>

</body>

</html>
