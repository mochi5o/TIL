package main
import "fmt"

// typeキーワードによる型の宣言
type myInt int

// 関数もtypeによる型宣言ができる
type myFunc func(x, y int) int

func main() {
	// myInt型の変数を使う
	var i myInt = 1
	fmt.Println(i + 1)

	// 関数リテラルで宣言したmyFunc型の関数を使う
  // 関数型の宣言は関数の引数や返り値として利用することで定義をまとめたりストラテジーとして扱うと便利らしい
	result := callMyFunc(func(x, y int) int {
		return x + y
	})
	fmt.Println(result)  // 3
}

// 引数が関数
func callMyFunc(fn myFunc) int {
	return fn(1, 2)
}
