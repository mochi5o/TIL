<?php
session_start();
// $＿SESSION['id’]編集したい行
// $_SESSIOM['contents'] 元のテキストの配列（改行なし）
// ＄＿POST編集内容
$array = $_SESSION['contents'];
$id = $_SESSION['id'];
$text = $_POST['ads'] .','. $_POST['pubid'] .',' .$_POST['type'] .','.$_POST['user'];
$array[$id] = $text;
// var_dump($array);
$adstxt = implode("\n" ,array_values($array));
// var_dump($adstxt);
file_put_contents('./domain/ads.txt', $adstxt);
$newAds = file_get_contents('./domain/ads.txt');
//    array_splice( $_SESSION['adstxt'], $id, 0, $text );
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ファイルを保存しました
    <div>
        <p>保存内容</p>
        <div>
            <?php echo $newAds; ?>
        </div>
    </div>
</body>
</html>