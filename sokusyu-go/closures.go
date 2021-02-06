package main
import "fmt"

func main() {
	// Closures
	x := 5
	fn := func() {
		fmt.Println("x is", x)
	}
	fn() // x is 5
	x++
	fn() // x is 6
}