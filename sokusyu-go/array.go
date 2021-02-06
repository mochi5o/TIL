package main

import "fmt"

func main() {
	// 配列長と型を指定する
	var array1 [2]int

	// 宣言と初期化
	array2 := [2]int{1, 2}

	// 初期化時は配列長を明示的に示さなくても...で代替できる
	array3 := [...]int{1, 2, 4, 5}

	fmt.Printf("%v, %v, %v", array1, array2, array3)
  // [0 0], [1 2], [1 2 4 5]
}
