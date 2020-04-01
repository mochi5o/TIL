<?php

// まだ読み込まれていないクラスを読んだら実行される関数
spl_autoload_register(function($classname){
    echo '新しく読み込みます： ' . $classname . PHP_EOL;
    $ds = DIRECTORY_SEPARATOR;

    // クラスの名前空間を含めたパスと実際のファイルパスをマッピング
    $autoloadCongfig = [
        'sample\ch06\WelcomeAutoload' =>
        __DIR__.$ds.'WelcomeAutoload.php'
    ];

    // クラスが定義されているphpファイルの読み込み（include）
    if (isset($autoloadCongfig[$classname])){
        include($autoloadCongfig[$classname]);
    }
});

//初回の呼び出しだけクラスの読み込みが走っていることがわかる
$sample = new \sample\ch06\WelcomeAutoload();
$sample->welcome();
// 実行結果
// 新しく読み込みます: sample\ch06\WelcomeAutoload
// Welcome to autoload!

$sample2 = new \sample\ch06\WelcomeAutoload();
$sample2->welcome();  // Welcome to autoload!
