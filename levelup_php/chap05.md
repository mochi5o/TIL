# 第5章〜

## 第5章

### 名前空間の使い方

```php
/**
 * これから定義するクラス（や関数、定数）に名前空間を付与する
 * 名前空間は階層化できる
 */

namespace sample\ch05;

class DateTime
{
    // 後は普通にクラスを定義する
}

// 現在のクラスで呼び出す時はそのまま呼べる
$datetime = new DateTime();
// 絶対パスを使って名前空間を初めから記述することもできる
$datetime = new \sample\ch05\DateTime();
// 本来の組み込み関数
$datetime = new \DateTime();
```

- デフォルトのクラスを呼ぶ時のバックスラッシュはデフォルトの名前空間（ルート空間）を表す
- 名前空間を使う理由
  - モジュール分割がやりやすい
  - クラス名が長くならなくて済む
  - オートロードと相性がいい
- 名前空間を指定する時はクラスファイルが置いてあるディレクトリパスと一致させるほうがいい
  - 読みやすい
  - オートロードの自動読み込みがやりやすい

### useによるショートカット

- 名前空間をuseで宣言するとエイリアスとして使うことができる
- PHP7からは同じ名前空間から複数のクラスをインポートする際にuseをまとめて定義できるようになった

```php
use \sample\ch05\DateTime as Dtm;
// こんな感じで呼び出せる
$datetime = new Dtm();

// 複数のインポート
use some\namespace\{ClassA, ClassB, ClassC as C};
```

## 第6章

### オートロード

- オートロード自体はPHP5.1からあるが、PHP5.3で名前空間に対応したことでより実用的になった
- `DIRECTORY_SEPARATOR`
  - OSの違いを吸収するPHPの定数
- オートロードの自動化
  - オートロードのファイルで読み込むクラスのパスをクラス名から指定すると自動化できる
  - 名前空間とディレクトリが対応していると指定しやすい
- require_once()との違い
  - オートロードだったら各ファイルでrequireしなくていい
  - 必要になるまで読み込みしない遅延実行で処理に無駄がない
  - 実は何度も呼ぶとrequire_onceはオーバーヘッドが高い

## 第7章

### 外部ライブラリ

- PECLとPEARとcomposer+Packagestの3種類が有名
  - PHPの外部ライブラリ
  - PECLでインストールするライブラリはPHPを拡張するライブラリなので、php.iniに拡張設定を記述する
- [PECL=PHP Extension Community Library](https://pecl.php.net/)
- [PEAR=PHP Extension and Application Repository](https://pear.php.net/)

```php.ini
extension=redis.so
```

```bash
PMAC747S:til mochiko$ pear info
pear info expects 1 parameter
PMAC747S:til mochiko$ pecl info
pear info expects 1 parameter
PMAC747S:til mochiko$
```

- PECLはC言語で書かれている
  - 言語レベルで拡張が行われている
  - 言語レベルの拡張なのでインストールしたモジュールはパフォーマンスが高い
  - 言語レベルの拡張なのでPHPのバージョナップで不整合が起きる可能性がある
- PEARは純粋なPHPのライブラリが中心
  - PECLよりも手軽
  - PECL/PEARはセットが多いので、PECLをインストールするとPEARも入ってくる
- conposer = packagist
  - Composerはパッケージのインストーラ
  - 実際のライブラリ郡はPackagistにある

```txt
- composer.json : 必要な外部ライブラリをjson形式で記述
- composer.lock : ライブラリのバージョンを固定する
- composer.phar : Composerの本体
- vendor/ : Composerによって自動的に生成され、パッケージがインストールされる場所
- vendor/autoload.php : Composerが自動生成したファイルでインストールされたパッケージを使うためのオートローダー
```

- composer.\[json,lock,par\]はGit管理下におき、vendor/はgitignoreする
- requireとrequire-dev
  - require-devは開発環境やテスト環境でのみ必要なパッケージのこと

```bash
# 開発用ライブラリをのぞいてインストールを実行
$ php composer.phar install --no-dev

# Composerのアップデート
$ php composer.phar self-update
```

