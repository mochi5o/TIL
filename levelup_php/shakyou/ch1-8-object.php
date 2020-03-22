<?php
$json = '{
    "title": "example",
    "price": 1000,
    "flags": { "onsale": true, "discount": false }
}';
$object = json_decode($json);

var_dump($object->title);
var_dump($object->flags->onsale);
var_dump($object);

// instanceofでクラスインスタンスを識別できる
class MyDateTime extends DateTime {}
$a = new MyDateTime();
var_dump($a instanceof MyDateTime);
var_dump($a instanceof stdClass);
// 継承したサブクラスのインスタンスも有効
var_dump($a instanceof DateTime);

class BaseController {
    public function __construct()
    {
        echo 'BaseController __construct()' .PHP_EOL;
    }

    public function run()
    {
        echo 'BaseController run()'.PHP_EOL;
    }
}

/**
 * 無名クラスによる即席コントローラー（基盤クラスを継承している）
 * BaseController __construct()
 * AnonymousController __construct()
 */
$controller = new class extends BaseController {
    public function __construct()
    {
        parent::__construct();
        echo 'AnnonymousController __construct()'.PHP_EOL;
    }
    public function run() {
        parent::run();
        echo 'AnonyumousController run()' .PHP_EOL;
    }
};

$controller->run();

// get_classで確認すると無名クラスもオブジェクトであることが分かる
echo get_class($controller).PHP_EOL;