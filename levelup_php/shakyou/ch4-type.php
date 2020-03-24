<?php

final class SampleClassNullDeclaration
{
    //クラスインスタンス（オブジェクト）で型宣言する
    public static function echoDate(DateTime $datetime)
    {
        echo $datetime->format('Y-m-d'). PHP_EOL;
    }

    //先頭に？があるとNULLも許容する
    public static function echoDateOrNull(?DateTime $dateTime)
    {
        if ($dateTime) {
            echo $dateTime->format('Y-m-d');
        } else {
            echo 'datetime is null';
        }
        echo PHP_EOL;
    }
}

SampleClassNullDeclaration::echoDate(new DateTime());

SampleClassNullDeclaration::echoDateOrNull(null);

// errorになる
SampleClassNullDeclaration::echoDate('test');
