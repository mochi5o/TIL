#!/bin/bash

list_recursive ()
{
    # ローカル変数の定義
    local filepath=$1
    local indent=$2

    # $(変数名##パターン) でパターンの最長マッチの前方一致を削除
    # */の最長マッチということは、ディレクトリ名かファイル名になるはず
    echo "${indent}${filepath##*/}"  # インデント付きでパス部分を取り除いてファイル名を表示する

    # $filepathがディレクトリだったらスペースを無視してfor文のfnameにlsの結果を渡す
    if [ -d "$filepath" ]; then
        local fname
        IFS=$'\n'
        for fname in $(ls "$filepath")
        do
            # インデントにスペースを追加して再起呼び出し
            list_recursive "${filepath}/${fname}" "    $indent"
        done
    fi
}

list_recursive "$1" ""
