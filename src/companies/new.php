<?php
//エラーを防ぐために(create.phpと帳尻合わせのために)errorsを定義。
$errors = [];
$company = [
    'name' => '',
    'establishment_date' => '',
    'founder' => '',
];

$title = '会社情報の登録';
$content = __DIR__ . '/views/new.php';
//絶対パスに変更
include __DIR__ . '/views/layout.php';
