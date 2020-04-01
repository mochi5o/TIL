<?php
$file = 'test.txt';

// 書き込み
$spl = new SplFileObject($file, 'w');
$spl->fwrite("a\nb\nc\n");
unset($spl);  // 変数が消えると自動的にcloseされる

// 読み込み
$spl = new SplFileObject($file, 'r');
foreach ($spl as $line) {
    echo $line;
}
unset($spl);  // 変数が消えると自動的にcloseされる

unlink($file);
