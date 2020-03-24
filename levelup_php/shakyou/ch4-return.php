<?php

declare(strict_types=1);

final class SampleReturnTyoe
{
    //整数もしくはNULLを返す関数であることを示す
    public static function numberNullReturn(int $number): ?int
    {
        if ($number === 1) {
            return null;
        }
        if ($number === 2) {
            return $number + 1;
        }
        // 戻り値が数値ではないのでエラーになる
        return false;
    }

    //何も帰らないことを保証する
    public static function voidReturn(int $number): void
    {
    }
}

// 何も表示されない（NULLが表示される）
echo SampleReturnTyoe::numberNullReturn(1). PHP_EOL;
// ３が表示される
echo SampleReturnTyoe::numberNullReturn(2) .PHP_EOL;

// エラー(想定外の型の返却)
echo SampleReturnTyoe::numberNullReturn(3) .PHP_EOL;
