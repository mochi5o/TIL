<?php

try {
    $result = 5 % 0;
} catch(\Error $e) {
    echo get_class($e) . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}