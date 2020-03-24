<?php

declare(strict_types=1);

function sample(): int
{
    // これはエラー
    return true;
}

try {
    sample();
} catch (Exeption $e) {
    // TypeErrorは通常のExeptionではない
} catch (TypeError $e) {
    //TypeErrorもしくはErrorのキャッチで捕捉できる
    echo 'Class: '.get_class($e).PHP_EOL;
    // 戻り値の型が違うのでエラー
    echo $e->getMessage().PHP_EOL;
}
