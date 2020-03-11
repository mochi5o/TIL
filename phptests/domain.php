<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>indexページ</title>
</head>
<body>
    <p>フォームからドメイン送信したら、画面遷移してルートディレクトリのテキストファイルの中身をリスト表示する</p>
    <form action="list.php" method="post">
        <input type="text" name="domain">
        <input type="hidden" name="action" value="domain">
        <input type="submit" value="送信">
    </form>
</body>
</html>
