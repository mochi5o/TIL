package main
import "fmt"

func main() {
	// 関数の実行
	result := add(1, 2)
	fmt.Println(result)

	// 多値を受け取る関数の実行
	a, b := swap("hello", "fukuoka.go")
	fmt.Println(a, b)

	// errorが発生したら戻り値のerrの内容を出力する
	result, err := div(2, 0)
	if err != nil {
		fmt.Printf("error: %s", err)  // %sにはerrが入る
	} else {
		fmt.Println(result)
	}
}

// 関数の定義は引数の型と戻り値の型を宣言する
func add(x int, y int) int {
        return x + y
}

// 多値を返すことができる
func swap(x, y string) (string, string) {
        return y, x
}

// error型を返す多値の例
func div(x, y int) (int, error) {
	if y == 0 {
		return 0, fmt.Errorf("divide by %d", y)  // %dにはyが入るので戻り値は0とエラーメッセージ
	}
	return x / y, nil  // 戻り値は除算結果とnil(＝エラー)
}