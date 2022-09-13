<?php

function validate($review) //バリデーションメソッドを用意
{
    $errors = [];

    //化粧品が正しく入力されているかチェック

    if (!strlen($review['product'])) {
        $errors['product'] = '化粧品名を入力してください';
    } else if (strlen($review['product']) > 100) {
        $errors['product'] = '化粧品名は100文字以内で入力してください';
    }

    //メーカー名をチェック

    if (!strlen($review['maker'])) {
        $errors['maker'] = 'メーカー名を入力してください';
    } else if (strlen($review['maker']) > 100) {
        $errors['maker'] = 'メーカー名は100文字以内で入力してください';
    }

    //使用期限をチェック
    if (!in_array($review['useByDate'], ['1年', '半年', '未使用'], true)) {
        $errors['useByDate'] = '使用期限は「1年」「半年」「未使用」のいずれかを入力してください';
    }


    //評価ログの整数かチェック
    if ($review['suggestion'] < 1 || $review['suggestion'] > 10) {
        $errors['suggestion'] = '1〜10の整数を入力してください';
    }
    //備考をチェック
    if (!strlen($review['etc'])) {
        $errors['etc'] = '備考を入力してください';
    } else if (strlen($review['etc']) > 255) {
        $errors['etc'] = '備考は255文字以内で入力してください';
    }
    return $errors;
}


function createReview($link)
{
    $review  = [];

    echo '化粧品ログを登録してください' . PHP_EOL;
    echo '化粧品名：';
    $review['product'] = trim(fgets(STDIN));

    echo 'メーカー名：';
    $review['maker'] = trim(fgets(STDIN));

    echo '使用状態(「1年」「半年」「未使用」のいずれか):';
    $review['useByDate'] = trim(fgets(STDIN));

    echo 'おすすめ度(10点満点の整数):';
    $review['suggestion'] = (int) trim(fgets(STDIN));

    echo '備考：';
    $review['etc'] = trim(fgets(STDIN));

    /**  validate関数でエラーがあったら戻り値がかえる。
     *バリデーションにエラーがあった場合
     *  $validatedに格納される
     */
    $validated = validate($review);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL; //エラーを全部表示
        }
        return; //登録処理されないようにreturnを返す。
    }

    $sql = <<<EOT
INSERT INTO cosmelog (
product_name,
product_maker,
use_by_date,
suggestion,
etc
)VALUES(
"{$review['product']}",
"{$review['maker']}",
"{$review['useByDate']}",
{$review['suggestion']},
"{$review['etc']}"
)


EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo '登録を完了しました' . PHP_EOL;
    } else {
        echo 'Error:データ追加に失敗しました' . PHP_EOL;
        echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    }
}

function listReviews($reviews)
{
    echo '化粧ログを表示します' . PHP_EOL;

    foreach ($reviews as $review) {
        echo '化粧品名：' . $review['product'] . PHP_EOL;
        echo 'メーカー名：' . $review['maker'] . PHP_EOL;
        echo '使用期限：' . $review['useByDate'] . PHP_EOL;
        echo 'おすすめ度：' . $review['suggestion'] . PHP_EOL;
        echo '備考：' . $review['etc'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    echo 'データベースに接続できました' . PHP_EOL;
    return $link;
}

$reviews = [];
$link = dbConnect();

while (true) {
    echo '1.化粧品ログを登録' . PHP_EOL;
    echo '2.化粧品ログを表示' . PHP_EOL;
    echo '9.アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';

    $num = trim(fgets(STDIN));
    if ($num === '1') {
        createReview($link);
    } elseif ($num === '2') {
        listReviews($reviews);
    } elseif (
        $num === '9'
    ) {
        mysqli_close($link);
        break;
    }
}
