<?php

/**
 * ここを追加
 *
 * データベースと接続するので dbConnect と名付けた
 */
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    echo 'データベースに接続できました' . PHP_EOL;
    /**
     * $link は mysqli_connect() の戻り値である、データベースとの接続情報
     * データベースと切断したり、テーブルからデータを取得・登録する際に接続情報を使用するので、return で返す
     */
    return $link;
}

$reviews = [];
/**
 * ここを追加
 *
 * 登録でも表示でもデータベースと接続するので、事前にデータベースと接続しておく
 * dbConnect() の戻り値を $link という新しい変数に入れる
 * dbConnect() 内の $link と同じ名前の変数を宣言しているけど、それとは別の変数
 * なぜ同じ名前を使っているかというと、dbConnect() の戻り値が $link（データベースとの接続情報）で、同じデータなので同じ名前を使っている
 */
$link = dbConnect();
function createReview()
{
    echo '化粧品ログを登録してください' . PHP_EOL;
    echo '化粧品名：';
    $product = trim(fgets(STDIN));
    echo 'メーカー名：';
    $maker = trim(fgets(STDIN));

    echo '使用期限(今日から1年後):';
    $useByDate = trim(fgets(STDIN));

    echo 'おすすめ度(10点満点):';
    $suggestion = trim(fgets(STDIN));

    echo '備考：';
    $etc = trim(fgets(STDIN));

    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return  [
        'product' => $product,
        'maker' => $maker,
        'useByDate' => $useByDate,
        'suggestion' => $suggestion,
        'etc' => $etc,
    ];
}

function displayReview($reviews)
{
    echo '化粧ログを表示します' . PHP_EOL;

    /**
     *修正
     *化粧ログを配列しなおす
     */
    foreach ($reviews as $review) {
        echo '化粧品名：' . $review['product'] . PHP_EOL;
        echo 'メーカー名：' . $review['maker'] . PHP_EOL;
        echo '使用期限：' . $review['useByDate'] . PHP_EOL;
        echo 'おすすめ度：' . $review['suggestion'] . PHP_EOL;
        echo '備考：' . $review['etc'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}


while (true) {
    echo '1.化粧品ログを登録' . PHP_EOL;
    echo '2.化粧品ログを表示' . PHP_EOL;
    echo '9.アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください(1,2,9):';

    $num = trim(fgets(STDIN));
    if ($num === '1') {
        $reviews[] = createReview();
    } elseif ($num === '2') {
        displayReview($reviews);
    } elseif (
        $num === 9
    ) {
        /**
         * ここを追加
         *
         * アプリケーション終了時にデータベースとの接続を切断する
         * $link はここで使う。なので dbConnect() が戻り値で $link を返す必要がある
         */
        mysqli_close($link);
        break;
    }
}
