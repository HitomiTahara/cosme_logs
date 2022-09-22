<h1 class="h3">化粧品ログの一覧</h1>

<a href="new.php" class="text-decoration-none  mb-4">化粧品ログを登録する</a>

<main>
    <?php if (count($cosme) > 0) : ?>
        <?php foreach ($cosme as $cos) : ?>
            <section class="mb-2">
                <h2><?php echo escape($cos['product_name']); ?></h2>
                <div>
                    メーカー名：<?php echo escape($cos['product_maker']); ?><br>
                    使用期限：<?php echo escape($cos['use_by_date']); ?><br>
                    評価：<?php echo escape($cos['suggestion']); ?><br>
                    備考：<?php echo escape($cos['etc']); ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
