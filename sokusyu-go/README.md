# Goやってみる

[公式](https://golang.org/)

環境メモ

```bash
~ ❯❯❯ go version
go version go1.14.2 darwin/amd64
~ ❯❯❯
```

- `import "fmt"`

[fmtパッケージ](http://golang.jp/pkg/fmt)

>fmtパッケージは、フォーマットI/Oを実装しており、C言語のprintfおよびscanfと似た関数を持ちます。フォーマットの「書式」はC言語から派生していますが、より単純化されています。

- iota列挙子

[enumっぽい使い方ができる。](https://blog.y-yuki.net/entry/2017/05/09/000000)

> 識別子iotaは、定数宣言文（const）内で使用される、型なしの連続する整数定数を表します。
> 本定数は予約語constが現れた時に0に初期化されて、各定数定義の後に1ずつインクリメントされます。
> ちなみに読み方は「イオタ」。
