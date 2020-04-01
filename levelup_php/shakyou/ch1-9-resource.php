<?php

function curl_access($url) {
    // リソースであるかどうか
    $ch = curl_init();
    var_dump(is_resource($ch));  // bool(true)
    var_dump(get_resource_type($ch));  // string(4) "curl"

    // アクセス先の設定
    curl_setopt($ch, CURLOPT_URL, $url);
    // trueにするとcurl_execの返り値が文字列になる
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 接続の試行を待ち続ける秒数（０は永遠に待ち続ける）
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    // アクセスの実行
    $res = curl_exec($ch);

    // cURLのエラーの有無
    if (curl_errno($ch) !== CURLE_OK) {
        //cURLが失敗した
        echo 'cURL error: ' . curl_error($ch). PHP_EOL;
        curl_close($ch);
        return;
    }

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // 200OKかどうか
    if ($statusCode === 200) {
        echo 'Curl success: ' . mb_substr($res, 0, 30). PHP_EOL;
    } else {
        //400BadRequestや404NotFoundなど
        echo 'Curl http error: ' . $statusCode. PHP_EOL;
    }

    // cURLセッションを終了する
    curl_close($ch);
}

// Curl success:
curl_access("https://www.impressrd.jp/");  // Curl success: <!DOCTYPE html PUBLIC "-//W3C/
// Curl error 404
curl_access("https://www.impressrd.jp/abcde");  // Curl http error: 404

