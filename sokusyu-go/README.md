# Goやってみる

[公式](https://golang.org/)
[日本語チュートリアル](http://golang.jp/go_tutorial)

### 環境メモ

```bash
~ ❯❯❯ go version
go version go1.14.2 darwin/amd64
~ ❯❯❯
```

[Goの基本](./Golang.md)

### 以下、雑なメモ

- セミコロン

> すでに気づかれたかと思いますがプログラム内にはセミコロンがありません。Go言語のコードでは通常、forループの各節を区切るぐらいにしかセミコロンは使いません。
[チュートリアル](http://golang.jp/go_tutorial)より

- `import "fmt"`

[fmtパッケージ](http://golang.jp/pkg/fmt)

>fmtパッケージは、フォーマットI/Oを実装しており、C言語のprintfおよびscanfと似た関数を持ちます。フォーマットの「書式」はC言語から派生していますが、より単純化されています。

### 変数定義

変数は宣言と同時に初期値が設定される

- 主なデータ型と初期値
  - string ""
  - int 0
  - float64 0.000000
  - bool false
  - nil

- iota列挙子

[enumっぽい使い方ができる。](https://blog.y-yuki.net/entry/2017/05/09/000000)

> 識別子iotaは、定数宣言文（const）内で使用される、型なしの連続する整数定数を表します。
> 本定数は予約語constが現れた時に0に初期化されて、各定数定義の後に1ずつインクリメントされます。
> ちなみに読み方は「イオタ」。

- if文

ifの条件式に使う変数を式で表せる（日本語...）

```go
if y := myFunc(); y == 0 {
	fmt.Println("Zero")
} else if y == 1 {
	// 宣言した値はここでも使える
	fmt.Println(y)
}
```

- 関数定義

関数宣言は`func`で行う
関数宣言時に戻り値の型も宣言する必要がある

```go
func myFunc() int {
	return 0
}
```

戻り値は複数返却できる（＝多値を返す）
>関数の戻り値などで利用していない変数があるとコンパイルできないので注意が必要
> 多値のうち、使わないものがあればブランク識別子_に代入すること
速習Goより

無名関数は変数に代入できる
>Goの関数は一級関数なのでリテラルを使って宣言した無名の関数を変数に格納することができます
速習Goより

[一級関数](https://ja.wikipedia.org/wiki/%E7%AC%AC%E4%B8%80%E7%B4%9A%E9%96%A2%E6%95%B0)
>関数を第一級オブジェクトとして扱うことのできるプログラミング言語の性質、またはそのような関数のことである。その場合その関数は、型のある言語では function type（en:Function type）などと呼ばれる型を持ち、またその値は関数オブジェクトなどになる。具体的にはプログラムの実行時に生成され、データ構造に含めることができ、他の関数の引数として渡したり、戻り値として返したりすることのできる関数をいう

- typeキーワードとGoの型

最初に書いた型以外の基本型（めちゃこまかい）

```txt
int  int8  int16  int32  int64
uint uint8 uint16 uint32 uint64 uintptr

byte // uint8 の別名

rune // int32 の別名
     // Unicode のコードポイントを表す

float32 float64

complex64 complex128
```

- 構造体
- 複数のフィールドと値を保持することができるもの

うーん、verb（書式指定子%~）を使う意味と使い分けがわかってないな。

下記のまま実行するとエラーがでる
`./prog.go:24:2: Printf format %s has arg p of wrong type *play.myStruct`

```go
package main

import "fmt"

// typeキーワードによる独自の構造体を宣言
type myStruct struct {
	i int
	s string
}

func main() {
	// フィールドの宣言順で初期化
	s1 := myStruct{1, "a"}

	// フィールド名を指定して初期化
	s2 := myStruct{i: 2, s: "b"}

	// ポインタの取得 アドレス演算子&によってアドレスを得る
	p := &myStruct{1, "a"}

	// フィールドへのアクセス
	fmt.Println(s1.i, s1.s)
	fmt.Println(s2.i, s2.s)
	fmt.Printf("p: %s", p)   // p: &{%!s(int=1) a}
}
```

https://qiita.com/rock619/items/14eb2b32f189514b5c3c

アドレスを表記したいなら%p、デフォルトのフォーマットなら%vを使ってあげると出力がエラーにならない。
`fmt.Printf("p: %p", p)  // p: 0xc00010c000`
`fmt.Printf("p: %v", p)  // p: &{1 a}`

- 変数に構造体を定義するときの記述

```go
var person struct {
    Name string
    Age  int
}
// 初期化したい場合
var person struct {
    Name string
    Age  int
}{
    Name: "Foo",
    Age:  10,
}
```

Nameがフィールド、stringが値（JSのオブジェクトとかRubyのハッシュかなぁ）
フィールドへのアクセス `person.Name = "Bar"`

- [typeとstructのちがい](https://qiita.com/tenntenn/items/45c568d43e950292bc31)
  - typeを使って既存の型や型リテラルに別名をつけることができる
    - typeは構造体だけのために用いられるものではない
  - structを使ってフィールドと値のセットに別名をつけることができる

その他のGoの特徴とか（ソフトウェアデザインより）

- gofmtを使ってフォーマットする
- Goではインデントにタブを使用する
- カッコは最低限
- 名前付けは簡潔に短く、がGoらしさ
- GoはCスタイルの `/* */` ブロックコメントとC++スタイルの `//` 行コメントが使える
- 構造体、関数、変数、定数の名前
  - 先頭を大文字なら外部パッケージへエクスポートできる
  - 先頭が小文字ならパッケージ内でのみ使用できる
    - ただしアクセスするためのエクスポートされた関数があれば利用することは可能（シングルトンパターンなど）

## Goのあれこれ

ここからさきは速習Goではなくいろいろな情報のかき集め。

型がある言語は「書くときにとっつきにくい」が、「読むときに楽」という話があった。

開発体験を優先させた結果書きやすいが運用が大変、みたいなことに対する反動だったり、
運用に重きを置くようになった結果なのではないか、という話を聞いてなるほど、となった。

引き合いに出されてたのはRubyで、書くの楽しいけど、「ここには何がはいってるの？」みたいなのが多くて大変、という話も。

個人的にはRubyもPHPも好きだけど、たしかにガッツリ運用しているわけではないのでツラみが理解できていないかも。

### Software Design 2019.5 特集 入門！G0より

#### Goの特徴

- 協力でシンプルな言語設計と文法

- 並行処理を言語レベルでサポートしている→ミドルウェアとかサーバ開発にも使われる
  - goroutineとchannel
go f()とかで関数呼び出しするとgoroutineを新たに作成できる（かんたん）


- ライブラリ群が充実している

- Goの標準ライブラリたち
  - fmt→　書式に関する機能
  - net/http→　HTTPサーバ、HTTPクライアント
  - crypto→　暗号化関連
  - encoding→　JSON,CSV,XMLなどのエンコーディング
  - html/template→　HTMLテンプレート
  - os, path/filepath→　OS固有の処理とかファイル関連

- 周辺ツール
  - テストツール
  - ベンチマーク
  - コードフォーマッタなどなど

- シングルバイナリ
  - Goのソースコードをビルドする→単一の実行可能ファイル（シングルバイナリ）が生成される
  - これにはGoのランタイムも含まれる

- クロスコンパイル
  - 開発マシン以外で動作する実行可能ファイルを生成できる

ここまで読んで、Goめちゃくちゃいいじゃん！！！！となっている。

- [Effective Go](https://golang.org/doc/effective_go.html)
- [日本語訳](http://go.shibu.jp/effective_go.html)

- 書式指定子とfmtパッケージの関数
  - Print／Println／Printf
  - [参考](https://leben.mobi/go/fmt-print-and-format/go-programming/)

>Print関数は、オペランドをデフォルトのフォーマットで標準出力への書きこみを行います。
>Println関数も同様に、デフォルトフォーマットで標準出力に書きこみますが、この際オペランドの間に半角スペースが入り、文字列の最後に改行が追加されます。
>Printf関数は、指定されたフォーマットに従ってフォーマットを行い、標準出力に書きこみます。

書式指定子を使うのはPrintf関数。

書式指定子を使うことで任意のフォーマットで出力が可能になる。

- Goの配列
  - 配列長と型を指定して配列を宣言する
- スライス
  - 配列を参照する仕組み
  - スライスの長さは動的で、スライス自体は参照型なので配列よりも扱いやすい
  - サイズ未指定、またはmake()を使用するとスライスが生成される

```go
// 配列の宣言
array0 := [3]int {1, 2, 3}
array1 := [...]int {1, 2, 3, 4}

// スライスの宣言
slice0 := []int {1, 2, 3}
slice1 := make([]int, 3, 5)
```

[スライスの動作はこれがわかりやすい](https://qiita.com/seihmd/items/d9bc98a4f4f606ecaef7)

- チャネルについて
  - 調べてたら、[これやるといいよ](https://gobyexample.com/)ってのがまた出てきた