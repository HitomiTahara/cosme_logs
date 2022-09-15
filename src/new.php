<?php
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
    <form action="" method="post">
        <div>
            <label for="product_name">化粧品名</label>
            <input type="text" name="product_name" id="product-name">
        </div>
        <div>
            <label for="product_maker">メーカー名</label>
            <input type="text" name="product_maker" id="product-maker">
        </div>
        <div>
            <label>使用状況</label>
            <div>
                <div>
                    <input type="radio" name="use_by_date" id="year" value="１年">
                    <label for="year">１年</label>
                </div>
                <div>
                    <input type="radio" name="use_by_date" id="half-year" value="半年">
                    <label for="half-year">半年</label>
                </div>
                <div>
                    <input type="radio" name="use_by_date" id="not-use" value="未使用">
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
