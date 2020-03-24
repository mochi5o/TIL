<?php
//数値と関係ない文字が混ざっているとfalseになる
$var = filter_var('123abc', FILTER_VALIDATE_INT);
var_dump($var);

//数値の123にキャストされる
$var = filter_var('123', FILTER_VALIDATE_INT);
var_dump($var);

// マイナスの数値にも対応している
$var = filter_var('-123', FILTER_VALIDATE_INT);
var_dump($var);
