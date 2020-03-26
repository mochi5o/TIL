<?php
/**
 * これから定義するクラス（や関数、定数）に名前空間を付与する
 * 名前空間は階層化できる
 */

namespace sample\ch05;

// namespaceを定義したので、sample\ch05\DateTimeというクラスになるので組み込みのDateTimeクラスと衝突しない
final class DateTime
{
    public function example()
    {
        return "My DateTime class";
    }
}

// 現在の名前空間のクラスを使う時はそのまま呼び出せる
$datetime = new DateTime();
echo $datetime->example() . PHP_EOL;

// 絶対パスを使って名前空間を初めから記述する
$datetime = new \sample\ch05\DateTime();
echo $datetime->example() . PHP_EOL;

// 組み込みのDateTimeクラスを使う時は先頭にバックスラッシュをつける
$datetime = new \DateTime();
echo $datetime->format('Y-m-d H:i:s') . PHP_EOL;