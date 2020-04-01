<?php

// ルーティング設定
$routerConfig = [
    '/phpinformation' => '/phpinformation'
];

// ルーティングがURIのパスを元に判定する
// ?クエリで誤判定してしまうのでパスだけ抜き出す
$urlPath = parse_url($_SERVER['REQUEST_URI'])['path'];
// $_SERVERはスーパーグローバル変数、parse_urlはurl文字列をパーツに分解して連想配列にする

// ルーティング設定に存在しない不正なURIを弾く処理
if (!isset($routerConfig[$urlPath])) {
    header("HTTP/1.0 404 Not Found");
    return;
}

// controllerの下にあるパスに対応したphpファイルを呼び出す
$basePath = __DIR__ . '/controller';
$ctrlPath = realpath($basePath.$routerConfig[$urlPath].'.php');
// realpathは相対パスの記述を展開して正規化したパスを返してくれる
if ($ctrlPath) {
    require($ctrlPath);
} else {
    header("HTTP/1.0 500 Internal Server Error");
    return;
}
