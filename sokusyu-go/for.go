package main
import "fmt"

func main() {
	// for
	sum := 0
	for i := 0; i < 10; i++ {
		sum += i
    fmt.Println(sum)
	}
	fmt.Println(sum)

	// 条件文のみのfor(これは0を足し続けるだけ)
	sum = 0
	for sum < 10 {
		sum += sum
	}
	fmt.Println(sum)

	// 無限ループ
	for {
	}
}