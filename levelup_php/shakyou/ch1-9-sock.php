<?php

// ソケット接続を確率する
$fp = fsockopen("www.example.com", 80, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
    exit;
}

// リソースであるかどうか
var_dump(is_resource($fp));
var_dump(get_resource_type($fp));

// HTTPの要求を書き込む
$out = "GET / HTTP/1.1\r\n";
$out .= "Connection: Close\r\n\r\n";
fwrite($fp, $out);

// 返却された内容（HTML）を終端に到達するまで読み込む
while (!feof($fp)) {
    // まずはレスポンスヘッダーが帰ってきて、その後にHTML本文が続く
    echo fgets($fp, 128);
}

// ソケット接続を終える
fclose($fp);
