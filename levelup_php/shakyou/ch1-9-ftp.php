<?php
// 書き方だけ
$file = 'somefile.txt';
$remote_file = 'readme.txt';

// SSL接続を確率する
$conn_id = ftp_ssl_connect($ftp_server);
// ユーザー名とパスワードでログインする bool
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

if (!$login_result) {
    // 既にPHP側でE_WARNINGのメッセージが発行されている
    die("can't login");
}

// ファイルをアップロードする
if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
    echo "successfully uploaded $file\n";
} else {
    echo "There was a problem while uploading $file\n";
}

// SSL接続を閉じる
ftp_close($conn_id);
