<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <title> <?php echo $title ?></title>
</head>

<body>
    <header class="navbar shadow-sm p-3 mb-5 bg-white">
        <h1 class="h2">
            <a href="index.php" class="text-body text-decoration-none">化粧品ログ</a>
        </h1>

    </header>
    <div class="container">
        <?php echo $contents ?>
    </div>

</body>

</html>
