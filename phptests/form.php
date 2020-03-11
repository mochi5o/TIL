<?php
session_start();
$params = [];
// var_dump($_POST['id']);
$id = (int)$_POST['id'];
$_SESSION['id'] = $id;
// $id = (int)$_POST['id'];
$content = $_SESSION['contents'][$id];
// var_dump($content);
// var_dump($_SESSION['contents']);
$keys = ['ads', 'pubid', 'type', 'user'];
$params = explode(",", $content, 4);
if (count($params) === 3){
    $params[] = "";
}
$params = array_combine($keys, $params);
// var_dump($params);
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
