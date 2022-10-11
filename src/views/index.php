<a href="new.php" class="btn btn-primary text-decoration-none mb-4">化粧品ログを登録する</a>

<main>
    <?php if (count($cosme) > 0) : ?>
        <?php foreach ($cosme as $cos) : ?>
            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <div>
                        <h2 class="card-title h4 text-dark"><?php echo escape($cos['product_name']); ?></h2>
                        <div class="small mb-3">
                            <?php echo escape($cos['product_maker']); ?>&nbsp;/&nbsp;
                            使用期限<?php echo escape($cos['use_by_date']); ?>&nbsp;/&nbsp;
                            評価<?php echo escape($cos['suggestion']); ?>
                        </div>
                        <p>備考：<?php echo escape($cos['etc']); ?></p>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>情報が確認できません</p>
    <?php endif; ?>
</main>
