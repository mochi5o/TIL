<?php

// 適当な関数とクラスを用意する
function myfunc(){};
class MyTest {
    static function mystafunc(){}
    function myfunc(){}
}

// myfyncは定義されているので呼び出し可能な関数
var_dump(is_callable('myfunc'));
// myfync2は定義されていないので呼び出し不可能
var_dump(is_callable('myfunc2'));

// MyTestのmystafuncは呼び出し可能な静的（クラス）メソッド
var_dump(is_callable(['Mytest', 'mystafunc']));

// is_callableは関数としてコール可能かどうか調べるだけ、本来はクラスインスタンスが必要な通常のメソッドもtrueになる
var_dump(is_callable(['MyTest', 'myfunc']));
$obj = new MyTest();
var_dump(is_callable($obj, 'myfunc'));

//無名関数は呼び出し可能
$anonymous = function(){ return true; };
var_dump(is_callable($anonymous));
