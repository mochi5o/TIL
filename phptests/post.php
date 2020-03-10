<?php
session_start();
$action = $_POST['action'];
$domainRoot = $_POST['domain'];
$contents = [];
if ($action === 'domain'){
    $file = './' . $domainRoot . '/ads.txt';
    $contents = str_replace(array("\r\n", "\r", "\n", " "), '',file($file));
} else {

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <p>ここにリスト表示</p>
    <form action="list.php" method="post">
    <table>
        <?php foreach ($contents as $id => $content) : ?>
        <tr>
            <td>
                <input type="radio" name="content" value="<?php echo $content;?>" />
            <?php echo $content;?>
            </td>
            <input type="hidden" value="<?php echo $id;?>" name="id">
            <td><button>edit</button></td>
            <td><button>delete</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
        <input type="submit" value="編集する">
    </form>
</body>
</html>
