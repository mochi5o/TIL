<?php

error_reporting(E_ALL);

if (is_null($z)) {
    // Notice
    echo '変数はNULLです' .PHP_EOL;
}

if (!isset($z)) {
    echo '変数は未定義かNULLです' .PHP_EOL;
}

if (empty($z)) {
    echo '変数は未定義かNULLか・・・' .PHP_EOL;
}


/**
 * NULL合体演算子
 */

// 普通に書くとこうなる(if文を使う)
if (isset($_GET['user'])) {
    $username = $_GET['user'];
} else {
    $username = 'nobody';
}

// またはこうなる(三項演算子)
$username = isset($_GET['user']) ? $_GET['user'] : 'nobody';

// NULL合体演算子（??を使う）
$username = $_GET['user'] ?? 'nobody';
echo $username.PHP_EOL;


/*
 * エルビス演算子
 */
// 普通にif
if ($name) {
    $username = $name;
} else {
    $username = '名前が空です';
}

// 三項演算子
$username = $name ? $name : '名前が空です';

// エルビス演算子 if($name) と同様の判定を行、$nameまたはデフォルト値を返却する
$username = $name ?: '名前が空です';
echo $username.PHP_EOL;
