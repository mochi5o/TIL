package main
import "fmt"

func main() {
	// const を使った定数の宣言と初期化
	const A int = 1

	// 型を省略可能
	const B = 1

	// グルーピング宣言とiota列挙子
	// 自動でインクリメントされる
	const (
		X = iota // 0
		Y        // 1
		Z        // 2
	)
	fmt.Println(A, B, X, Y, Z)
	// 1 1 0 1 2
}
