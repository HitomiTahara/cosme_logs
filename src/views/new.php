<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <title>コスメログ</title>
</head>

<body>
    <header class="navbar shadow-sm p-3 mb-5 bg-white">
        <h1 class="h2">
            <a href="index.php" class="text-body text-decoration-none">化粧品ログ</a>
        </h1>

    </header>
    <div class="container">

        <h2 class="h3 text-gray mb-4">化粧品の登録</h2>

        <form action="create.php" method="POST">
            <?php if (count($errors)) : ?>
                <ul class="text-danger">
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?> </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="mb-3">
                <label for="product-name">化粧品名</label>
                <input type="text" name="product-name" id="product-name" value="<?php echo $cosme['product-name'] ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="product-maker">メーカー名</label>
                <input type="text" name="product-maker" id="product-maker" value="<?php echo $cosme['product-maker'] ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label>使用状況</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="use-by-date" id="year" value="１年" class="form-check-input" <?php echo ($cosme['use-by-date'] === '１年') ? 'checked' : ''; ?>>
                        <label for=" year" class="form-check-label">１年</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="use-by-date" id="half-year" class="form-check-input" value="半年">
                        <label for="half-year" class="form-check-label">半年</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="use-by-date" id="not-use" class="form-check-input" value="未使用">
                        <label for="not-use" class="form-check-label">未使用</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="suggestion">おすすめ度（10満点の整数）</label>
                <input type="number" name="suggestion" id="suggestion" value="<?php echo $cosme['suggestion'] ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="etc">備考</label>
                <textarea type="text" id="etc" name="etc" rows="10" class="form-control"><?php echo $cosme['etc'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>

</body>

</html>
