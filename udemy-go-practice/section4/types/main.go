package main

import (
	"fmt"
)

func main(){
	/*
  * int型
	*/
	// intだけで指定すると環境依存になる.intの方が違うと演算はできない
	var i int = 100
  fmt.Println(i + 50)  // 150

	var i2 int64 = 200
	// 型を調べることができる
	fmt.Printf("%T\n", i2)  // int64

	fmt.Printf("%T\n", int32(i2))  // 型の変換

  var fl64 float64 = 2.4
	fmt.Println(fl64)  // 2.4

	// 暗黙的な定義はfloat64になる
  fl := 3.2
	fmt.Println(fl64 + fl)  // 5.6
	fmt.Printf("%T, %T\n", fl64, fl)  // float64, float64

	var fl32 float32 = 1.2  // 基本的にはfloat32はあまり使わない
	fmt.Printf("%T\n", fl32)  //float32

	// 型変換
	fmt.Printf("%T\n", float64(fl32))  // float64

	// 演算不能な特殊な型
	zero := 0.0
  pinf := 1.0 / zero
  fmt.Println(pinf)  // +Inf

	ninf := -1.0 / zero
	fmt.Println(ninf)  // -Inf

	nan := zero / zero
	fmt.Println(nan)  // NaN


	/*
  * bool型
	*/
	var t, f bool = true, false
	fmt.Println(t, f)  // true false

	/*
  * string型
	*/
	var str string = "hello golang"
	fmt.Println(str) // hello golang
	fmt.Printf("%T\n", str)  // string

	var si string = "300"
	fmt.Println(si) // 300
	fmt.Printf("%T\n", si)  // string

  // 複数行の文字列の表示
  fmt.Println(`test
	test
		test`)

	// バックスラッシュを文字列としてあつかう
	fmt.Println("\"")
	fmt.Println(`"`)

	// hello golangの一文字目を取得(文字列はバイト配列のあつまり)
	fmt.Println(string(str[0]))  // h


	/*
  * byte型
	*/
  byteA := []byte{72, 73}
	fmt.Println(byteA)  // [72 73] byte配列

	// byte配列を文字列に変換して表示
	fmt.Println(string(byteA))  // HI

	// 文字列をbyteのスライスに変換して表示→文字列で表示
	c := []byte("HI")
	fmt.Println(c)  // [72 73]
	fmt.Println(string(c))  // HI


	/*
  * 配列型  他の言語の配列と違って要素の追加ができないので注意
	*/
	var arr1 [3]int
	fmt.Println(arr1)  // [0 0 0]
	fmt.Printf("%T\n", arr1)  // [3]int →要素数を含んだ型になってる＝要素数を変更できない

	var arr2 [3]string = [3]string{"A", "B"}
	fmt.Println(arr2)  // [A B ] →要素数は2個しか指定していないので3個めの要素は空文字（stringのデフォルト）で入っている

	// 暗黙的な型定義
	arr3 := [3]int{1, 2, 3}
	fmt.Println((arr3))  // [1 2 3]

  // 暗黙的な要素数の指定 [...]で与えた要素数の配列型を定義する
	arr4 := [...]string{"c", "d"}
	fmt.Println(arr4)  // [c d]
	fmt.Printf("%T\n", arr4)  // [2]string
}