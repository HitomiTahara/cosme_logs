<h1>会社情報の一覧</h1>
<a href="new.php" class="text-decoration-none">会社情報を登録する</a>

<main>
    <?php if (count($companies) > 0) : ?>)
    <?php foreach ($companies as $company) : ?>
        <section>
            <h2><?php echo escape($company['name']); ?></h2>
            <div>
                創業：<?php echo escape($company['establishment_date']); ?>年|<?php echo escape($company['founder']); ?></div>
        </section>
    <?php endforeach; ?>
<?php endif; ?>
</main>
