<?php
$errors = [];
$cosme = [
    'product-name' => '',
    'product-maker' => '',
    'use-by-date' => '１年',
    'suggestion' => '',
    'etc' => '',
];

$title = '化粧品の登録';
$contents include . __DIR__ . '/views/new.php';
include  __DIR__ . '/views/layout.php';
