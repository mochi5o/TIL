package main

import (
	"fmt"
)

func main(){
	/*
  * 配列型
  * 他の言語の配列と違って要素の追加ができないので注意
  * 要素数を変更する場合はスライス型をつかうこと
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

	/*
  * 配列のとりだし
	*/
	fmt.Println(arr2[0])  // A

  /*
  * 配列の値の更新
	*/
	arr2[2] = "C"
	fmt.Println(arr2)  // [A B C]

  /*
  * 配列の要素数を調べる
	*/
	fmt.Println(len(arr1))  // 3
}