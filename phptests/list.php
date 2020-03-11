<?php
session_start();
$action = $_POST['action'];
$domainRoot = $_POST['domain'];
$contents = [];
if ($action === 'domain'){
    $file = './' . $domainRoot . '/ads.txt';
    $contents = str_replace(array("\r\n", "\r", "\n", " "), '',file($file));
} else {
// 例外処理
}
$_SESSION['contents'] = $contents;
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
    <table>
        <?php foreach ($contents as $id => $content) : ?>
        <tr>
            <td>
            <?php echo $content;?>
            </td>
            <td>
                <form action="form.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <button type="submit">edit</button>
                </form>
            </td>
            <td>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <button type="submit" id="confirm">delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <script>
        document.getElementById('confirm').onclick = function(){
            confirm('削除していいですか');
        }
    </script>
</body>
</html>
