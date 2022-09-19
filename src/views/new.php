<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
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
            <input type="text" name="product-name" id="product-name" value="<?php echo $cosme['product-name'] ?>">
        </div>

        <div>
            <label for="product-maker">メーカー名</label>
            <input type="text" name="product-maker" id="product-maker" value="<?php echo $cosme['product-maker'] ?>">
        </div>

        <div>
            <label>使用状況</label>
            <div>
                <div>
                    <input type="radio" name="use-by-date" id="year" value="１年" <?php echo ($cosme['use-by-date'] === '１年') ? 'checked' : ''; ?>>
                    <label for=" year">１年</label>
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
            <input type="number" name="suggestion" id="suggestion" value="<?php echo $cosme['suggestion'] ?>">
        </div>

        <div>
            <label for="etc">備考</label>
            <textarea type="text" id="etc" name="etc" rows="10"><?php echo $cosme['etc'] ?></textarea>
        </div>


        <button type="submit">登録する</button>
    </form>

</body>

</html>
