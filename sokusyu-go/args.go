package main
import "fmt"

func main() {
  // 変数の定義
  var a int
  var b int = 1
  // 初期値があれば型の省略が可能
  var c =2
  d := 3

  fmt.Println(a, b, c, d)
  // 0 1 2 3

  // :=では定義済みの変数に再代入できない
  // :=は宣言と代入を一緒に実行する（var省略)
  a := 5
  fmt.Println(a)
  // ./main.go:16:5: no new variables on left side of :=

  // 複数同時に定義
  y, z := 10, 14
  fmt.Println(y, z)
  // 10 14
}

// main関数外で:=を用いた変数宣言ができない
f := 7
fmt.Println(f)
// ./main.go:22:1: syntax error: non-declaration statement outside function body