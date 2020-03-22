<?php
trait transport1 {
    // static 関数
    static function test() {
        echo "test!" .PHP_EOL;
    }

    // インスタンス関数
    function canRide() {
        echo "Can Ride!" .PHP_EOL;
    }
}
trait transport2 {}

class Base {
    function ridePrice() {
        return 100;
    }
}

// TaxiクラスはBaseを継承
class Taxi extends Base {
    // 多重継承ができないがtraitを使ったクラスの拡張は可能
    use transport1, transport2;
}

class Train extends Base {
    // traitは他のクラスでも使い回すことができる
    use transport1, transport2;
}

// useで拡張したtraitメソッドはオブジェクト自身の関数と同じように使用できる
Taxi::test();  //->test!
$taxi = new Taxi();
$taxi->canRide();  //->canRide!
