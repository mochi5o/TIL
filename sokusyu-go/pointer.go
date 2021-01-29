package main
import "fmt"

func main() {
	// int型の変数iを宣言
	i := 1

	// int型のアドレスを格納できるポインタの型(*int)を宣言
	var p *int

	// アドレス演算子(&)によって変数からアドレスを得る
	p = &i

	// 間接参照演算子(*)によってアドレスから変数を得る
	fmt.Println(*p, p) // 1,iの値が格納されているアドレス(実行時は0xc00002c008だった）
	i = 2
	fmt.Println(*p, i) // 2,2
}