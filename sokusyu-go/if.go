package main
import "fmt"

func main() {
	var x int // 初期値は0
	if x == 0 {
		fmt.Println("Zeroed")
	}

	// 条件式の前に文を書くことができる
	// yには関数の実行結果が初期化と同時に定義される
	if y := myFunc(); y == 0 {
		fmt.Println("Zero")
	} else if y == 1 {
		// 宣言した値はここでも使える
		fmt.Println(y)
	}
}

func myFunc() int {
	return 0
}