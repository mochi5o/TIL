<?php
var_dump(is_iterable([1, 2, 3]));
var_dump(is_iterable(new ArrayIterator([1, 2, 3])));
var_dump(is_iterable((function(){ yield 1; })()));

// falseになる
var_dump(is_iterable(1));
var_dump(is_iterable(new stdClass()));

// yieldの例
function gen_one_to_three() {
    for ($i = 1; $i <= 3; $i++) {
        // yield を繰り返す間、$i の値が維持されることに注目しましょう
        yield $i;
    }
}

$generator = gen_one_to_three();
foreach($generator as $value){
    echo "$value\n";
}