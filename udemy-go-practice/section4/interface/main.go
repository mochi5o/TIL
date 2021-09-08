package main

import (
	"fmt"
	"strconv"
)

func main() {
	var x interface{}
	fmt.Println(x)  // <nil> なんでも当てはまる型

	x = 1
	fmt.Println(x)  // 1
	x = 3.14
	fmt.Println(x)  // 3.14
	x = [3]int{1, 2, 3}
	fmt.Println(x)  // [1 2 3]

  // 演算はできない
	// x = 2
	// fmt.Println(x + 2)  // invalid operation: x + 2 (mismatched types interface {} and int)

  /*
  * 型変換
  */
	var i int = 1
	fl64 := float64(i)
	fmt.Println(fl64)  // 1
	fmt.Printf("i = %T\n", i)  // i = int
	fmt.Printf("fl64 = %T\n", fl64)  // fl64 = float64

	i2 := int(fl64)
	fmt.Printf("i2 = %T\n", i2)  // i2 = int

	fl := 10.5
	i3 := int(fl)
	fmt.Println(i3)  // 10  小数点は切り捨てになっている
	fmt.Printf("i3 = %T\n", i3)  // i3 = int

  /*
  * string型とint型の変換
  */
  // 文字列→数値
	var s string = "100"
	fmt.Printf("%T\n", s)

	i, _ = strconv.Atoi(s)  // 100 _をつかうことで2つ目のAtoi関数から返ってくる変数を破棄することができる
	fmt.Println(i)  // 100
	fmt.Printf("i = %T\n", i)  // i = int

  // _で値を破棄しない場合はエラーハンドリング
	a, err := strconv.Atoi("A")
	if err != nil {
		fmt.Println(err)  // strconv.Atoi: parsing "A": invalid syntax
	}
	fmt.Println(a)  // 0  int型のデフォルト値
	fmt.Printf("a = %T\n", a)  // a = int

	// 数値→文字列
	var i4 int = 200
	s2 := strconv.Itoa(i4)
	fmt.Println(s2)
	fmt.Printf("s2 = %T\n", s2)  // s2 = string

	// byte配列と文字列型
	var h string = "hello world"
	b := []byte(h)
	fmt.Println(b)  // [104 101 108 108 111 32 119 111 114 108 100]

  h2 := string(b)
	fmt.Println(h2)  // hello world
}