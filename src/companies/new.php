<?php
//エラーを防ぐために(create.phpと帳尻合わせのために)errorsを定義。
$errors = [];
$company = [
    'name' => '',
    'establishment_date' => '',
    'founder' => '',
];
include 'views/new.php';
