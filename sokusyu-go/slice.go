import "fmt"

func main() {
	// スライス型
	var slice []int
	fmt.Println(slice)
	// []

	// 配列の中身へのアクセス
	a := [4]string{"a", "b"}
	a[2] = "c"
	a[3] = "d"
	fmt.Println(a)
	//[a b c d]

	// 配列からスライス
	array1 := [3]int{1, 2, 3}
	slice = array1[:]   // 配列全体をスライス
	fmt.Println(slice)  // [1 2 3]
	slice = array1[0:5] // 配列の一部分をスライス（配列長をオーバーして参照できる）
	fmt.Println(slice)  // [1 2]

	// スライスとして宣言する
	slice = []int{1, 2, 3}
	fmt.Println(slice)  // [1 2 3]

	// スライスへの要素の追加
	slice = append(slice, 4, 5)
	fmt.Println(slice)  //[1 2 3 4 5]

	// 要素の追加はスライスに対して行う
	b := [2]string{"Penn", "Teller"}
	sliceb := b[:]
	appb := append(sliceb,"Mike", "Jacky")
	fmt.Println(appb)  // [Penn Teller Mike Jacky]

	// スライスへのスライスの追加
	slice2 := []int{6, 7}
	slice = append(slice, slice2...)
	fmt.Println(slice)
  // [1 2 3 4 5 6 7]
}
