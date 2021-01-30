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
	fmt.Println(s1.i, s1.s)  // 1 a
	fmt.Println(s2.i, s2.s)  // 2 b
	fmt.Printf("p: %p", p)   // p: 0xc00000c0a0
}