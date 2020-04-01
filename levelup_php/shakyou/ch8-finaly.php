<?php
class RandomException extends \Exception {}

function writeFile($file) {
    $fp = null;
    try {
        $fp = fopen($file, 'w');
        if (rand(0, 1) > 0.5) {
        throw new \RandomException('ランダムに失敗しました');
        } else {
        throw new \Exception('処理が失敗しました');
        }
    } catch (RandomException $e) {
        echo $e->getMessage() . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    } finally {
        if (is_resource($fp)) {
        echo 'ファイルポインタを閉じます' .PHP_EOL;
        fclose($fp);
        }
    }
}

writeFile('./test.txt');
unlink('./test.txt');

/**
 * 出力
 * PMAC747S:til mochiko$ php levelup_php/shakyou/ch8-finaly.php 
 * 処理が失敗しました
 * ファイルポインタを閉じます
 * PMAC747S:til mochiko$ php levelup_php/shakyou/ch8-finaly.php 
 * 処理が失敗しました
 * ファイルポインタを閉じます
 * PMAC747S:til mochiko$ php levelup_php/shakyou/ch8-finaly.php 
 * 処理が失敗しました
 * ファイルポインタを閉じます
 * PMAC747S:til mochiko$ php levelup_php/shakyou/ch8-finaly.php 
 * ランダムに失敗しました
 * ファイルポインタを閉じます
 */