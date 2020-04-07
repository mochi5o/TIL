<?php
session_start();
$params = [];
$id = $_POST['id'];

echo 'idは、、、';
var_dump($id);

if (preg_match('/\A[0-9]*\Z/', $id) === 1){
    echo '数字です';
}else{
    echo '例外発生:idが数字ではない';
    exit();
}
$cont_length = count($_SESSION['contents']);
$cont_arr = str_split ($cont_length, $split_length = 1);
var_dump($cont_arr);
$id_arr = str_split ($id, $split_length = 1);
if(count($cont_arr) === count($id_arr)){
    echo '正常のidの範囲です、配列の一個めをintで比較します。OKだったらそのまま使うけどダメだったら例外発生';
    $id = ((int)$cont_arr[0] >= (int)$id_arr[0]) ? (int)$id : '例外発生';
    var_dump($id);
}elseif(count($cont_arr) > count($id_arr)){
    echo '正常のidの範囲です。そのままidをintにキャストします';
    $id = (int)$id;
    var_dump($id);
}else {
    echo '例外発生:idの方が大きい';
    exit();
}

$_SESSION['id'] = $id;
$content = $_SESSION['contents'][$id];
$keys = ['ads', 'pubid', 'type', 'user'];
$params = explode(",", $content, 4);
if (count($params) === 3){
    $params[] = "";
}
$params = array_combine($keys, $params);
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="complete.php" method="post">
    <input type="text" name="ads" value="<?php echo $params['ads']; ?>">
    <input type="text" name="pubid" value="<?php echo $params['pubid']; ?>">
    <input type="text" name="type" value="<?php echo $params['type']; ?>">
    <input type="text" name="user" value="<?php echo $params['user']; ?>">
    <input type="submit" value="登録">
</form>

</body>
</html>
