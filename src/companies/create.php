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
    if (!$result) {
        error_log('error:fail to create company');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}

function validate($company)
{
    $errors = [];
    //会社名
    if (!strlen($company['name'])) {
        $errors['name'] = '会社名を入力してください';
    } elseif (strlen($company['name']) > 255) {
        $errors['name'] = '会社名は255文字以内で入力してください';
    }
    //設立日
    $ckDate = explode('-', $company['establishment_date']);
    var_dump(count($ckDate));
    var_dump(checkdate($ckDate[1], $ckDate[2], $ckDate[0]));

    if (!strlen($company['establishment_date'])) {
        $errors['establishment_date'] = ' 設立日を入力してください';
    } elseif (count($ckDate) !== 3) {
        $errors['establishment_date'] = ' 設立日を正しい形式で入力してください';
    } elseif (!checkdate($ckDate[1], $ckDate[2], $ckDate[0])) {
        $errors['establishment_date'] = ' 設立日を正しい日付で入力してください';
    }

    //設立者
    if (!strlen($company['founder'])) {
        $errors['founder'] = '設立者を入力してください';
    } elseif (strlen($company['founder']) > 100) {
        $errors['founder'] = '設立者は100文字以内で入力してください';
    }



    return $errors;
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
    //バリデーションがはなければ・・・接続・登録・切断を実行
    $errors = validate($company);

    if (!count($errors)) {
        //データベースに接続
        $link = dbConnect();
        //データベースにデータを登録する
        createCompany($link, $company);
        //データベースとの接続を切断
        mysqli_close($link);
        //リダイレクト処理
        header("location: index.php");
    }
    // もしエラーがあれば
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社情報の登録</title>
</head>

<body>
    <h1>会社情報の登録</h1>
    <form action="create.php" method="POST">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>

            <php endif; ?>
                <div>
                    <label for="name">会社名</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <label for="establishment_date">創立日</label>
                    <input type="date" id="establishment_date" name="establishment_date">
                </div>
                <div>
                    <label for="founder">設立者</label>
                    <input type="text" id="founder" name="founder">
                </div>
                <button type="submit">登録する</button>
    </form>
</body>

</html>
