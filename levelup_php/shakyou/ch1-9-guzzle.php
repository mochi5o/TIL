<?php
// 実際にインストールしていないので書き方だけ
$client = new \GuzzleHttp\Client();
$res = $client->request(
    'GET',
    'http://api.github.com/repos/guzzle/guzzle'
);

echo $res->getStatusCode();
echo $res->getHeaderLine('content-type');
echo $res->getBody();

$request = new \GuzzleHttp\Psr7\Request(
    'GET',
    'http://httpbin.org'
);

$promise = $client->sendAsync($request)
    ->then(function ($responce) {
        echo 'I completed!' . $responce->getBody();
    });
$promise->wait();
