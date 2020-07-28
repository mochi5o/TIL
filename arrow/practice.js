// アロー関数の例
let sum = (a, b) => a + b;
console.log(sum(1, 2))  // 3

// 上記の関数をfunction~に書き換えると…
let sum = function(a, b){
    return a + b;
}

// 引数が一つの場合のアロー関数
let double = n => n * 2;
console.log(double(5));  // 10

// 引数がない場合は()だけ書く
let random = () =>  Math.floor(Math.random() * Math.floor(5));  // 0~4の乱数

// 関数の中でアロー関数を呼ぶ
let baseArray = [1,2,3,4,5];
let newArray = baseArray.map(value => value * 2);
console.log(newArray); // =>[2,4,6,8,10]