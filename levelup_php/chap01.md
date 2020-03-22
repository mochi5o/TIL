# 導入〜第1章

## float

- 小数点の扱いに気をつける
  - 小数を直接比較して、等しいかどうかを調べてはならない
  - 小数は表現の限界により、丸めによる誤差が発生する可能性がある
  - 正確に値を表現できない小数が存在するということを忘れてはならない
- けたあふれ＝オーバーフロー

```
/** 整数の範囲を超えると桁あふれ(オーバーフロー)現象がおきる **/
$overMax = PHP_INT_MAX + 100;
var_dump($overMax); // float(9.2233720368548E+18)
$overMin = PHP_INT_MIN - 100;
var_dump($overMin); // float(-9.2233720368548E+18)

/** 桁あふれの環境下では正確な判定ができない **/
$over100 = PHP_INT_MAX + 100;
$over101 = PHP_INT_MAX + 101;
var_dump($over100 === $over101); // bool(true)
```

## 文字コード

- PHPの内部的な文字コード情報はPHPの設定ファイルである`PHP.ini`で行う
  - [phpマニュアル](https://www.php.net/manual/ja/ini.core.php#ini.default-charset)
  - [もういい加減覚えよう。php.iniはどこにあるのか](https://qiita.com/ritukiii/items/624eb475b85e28613a70)
- `mb_convert_encoding` 文字コードの変更
- php.iniの設定
  - https://qiita.com/ritukiii/items/624eb475b85e28613a70
  - `/private/etc/php.ini.default`
  - `/etc/php.ini.default`
- 改行のこと
  - [nl2br](https://www.php.net/manual/ja/function.nl2br.php)

```
/** 改行コードを<br>タグに変換する **/
// foo isn't <br />
// bar
echo nl2br("foo isn't \r\n bar").PHP_EOL;
echo "----------".PHP_EOL;
// foo isn't <br />
// bar
echo nl2br("foo isn't \n bar").PHP_EOL;

```

## 配列

### 添字配列と連想配列

```
/** 添字配列の基本形(要素名を付けない) **/
$a = ['a', 'b'];
// array(2) {[0]=> string(1) "a" [1]=> string(1) "b"}
var_dump($a);

/** 連想配列の基本形(要素名を付ける) **/
$b = [
    "a" => "b",
    "c" => "d",
];
```

- array_mergeと＋による配列の結合の違い
  - array_mergeの方が自然
  - ＋は常に左側が優先される
  - とはいえ予測できない動作をすることもある

- array_pushとarray[]を使う方法
  - `array[]`を使った方がオーバーヘッドが少ない https://www.php.net/manual/ja/function.array-push.php

### 可変長引数（PHP 5.6）

```
// $numbersは引数の数によって増減する配列となる
function sum(...$numbers) {
    $acc = 0;
    foreach ($numbers as $n) {
        $acc += $n;
    }
    return $acc;
}

/**
 * (PHP5.6)...による配列の引数展開
 */

function fruits($a, $b, $c) {
    echo $a.PHP_EOL; // りんご
    echo $b.PHP_EOL; // みかん
    echo $c.PHP_EOL; // バナナ
}

// 配列を展開して引数に渡します
$array = ['りんご', 'みかん', 'バナナ'];
fruits(...$array);
```

- ただし引数展開する際に引数で渡す配列が短いとエラーになる
  - なので実はあまり使わない
- 配列の並び替えでは、単純なsort()関数がもっとも有名
  - ただし、sort()には連想配列の対応関係を維持しないという特徴があるので連想配列には使えない
  - [いろんなsort系の関数がある](https://www.php.net/manual/ja/array.sorting.php)

## iterable型

- PHP7.1から導入された擬似型
  - [マニュアル](https://www.php.net/manual/ja/language.types.iterable.php)
  - 簡単にいうとforeachで繰り返しが使える変数の型
- ジェネレータ
  - [ジェネレータとは](https://www.php.net/manual/ja/language.generators.overview.php)
  - [ジェネレータの構文](https://www.php.net/manual/ja/language.generators.syntax.php#control-structures.yield)
  - yieldが含まれていればどんな関数でもジェネレータ関数
- [トレイト](https://www.php.net/manual/ja/language.oop5.traits.php)

## curlとGuzzle

- [curl_init](https://www.php.net/manual/ja/function.curl-init.php)
- curlコマンドはhttpリクエストを実行できるコマンド
  - curl_init()で初期化してお決まりの書き方で接続、Web上の情報（resource）を取得できる
  - CURLXXXXという定数がたくさんある
  - curl_close()で閉じて終了
- Guzzle
  > GuzzleはHTTPクライアントのパッケージで、一言で説明すると「高性能なcurl関数のラッパー」です。みなさんはAPI通信やスクレイピングを行う時に、どのようにして外部サーバからHTTPで通信する方法があるでしょうか。
    
    ということらしい。

## 外部リソースと異常系

- リソース型の変数は、ファイル、ネットワーク、データベースなど外部環境とのやりとりを伴うので常に失敗のリスクがある
- リソース型を扱うときは、常に異常系を正しく検出できるかどうかを意識すること
  - 正常系の処理を書き終えても進捗は50%程度と考える（！）
- curl, Guzzle, ftp_ssl_connect(), などいろんなアクセス方法がある
