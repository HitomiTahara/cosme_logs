<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <title>会社情報の登録</title>
</head>

<body>
    <div class="container">
        <h1 class="h2 text-dark mt-4 mb-4">会社情報の登録</h1>
        <form action="create.php" method="POST">
            <?php if (count($errors)) : ?>
                <ul class="text-danger">
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
                </ul>
                <php endif; ?>
                    <div class="mb-3">
                        <label for="name">会社名</label>
                        <input type="text" id="name" name="name" value="<?php echo $company['name'] ?>" class="form-control mb-2">
                    </div>
                    <div class="mb-3">
                        <label for="establishment_date">創立日</label>
                        <input type="date" id="establishment_date" name="establishment_date" value="<?php echo $company['establishment_date'] ?>" class="form-control mb-2">
                    </div>
                    <div class="mb-3">
                        <label for="founder">設立者</label>
                        <input type="text" id="founder" name="founder" value="<?php echo $company['founder'] ?>" class="form-control mb-2>
                    </div>
                    <button type=" submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
</body>

</html>
