<?php
class A {
    public static function who() {
        // 定義した時点で__CLASS__=自分自身（Aクラス）となる
        echo __CLASS__.PHP_EOL;
    }
    public static function testSelf() {
        // 定義した時点でself=自分自身（Aクラス）となる
        self::who();
    }
    public static function testStatic() {
        // staticが誰を指し示すかは実行時に決まる
        // Aを継承したクラス経由で呼び出されるとstatic=継承先のクラスとなる
        static::who();
    }
}

class B extends A {
    public static function who() {
        // 定義した時点で＿＿CLASS＿＿＝自分自身（Bクラス）となる
        echo __CLASS__.PHP_EOL;
    }
}

B::testSelf();
B::testStatic();