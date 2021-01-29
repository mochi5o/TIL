<?php

final class SampleException extends \Exception{}

try {
    if (1 !== 0){
        throw new SampleException('1 is not 0');
    }
} catch(\SampleException $e) {
    echo $e->getMessage() .PHP_EOL;
}