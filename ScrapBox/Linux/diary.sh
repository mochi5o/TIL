#!/bin/bash

# 日記を書くためのスクリプト
# 日付はYYYY-MM-DD方式で表記して2020-01-01.txtのようなファイル名で保存

# 日記データの保存ディレクトリ
directory="${HOME}/diary"

# データ保存ディレクトリがなければ作成する
if [ ! -d "$directory" ]; then
    mkdir "$directory"
fi

diaryfile= "${directory}/$(date '+%Y-%m-%d').txt"

if [ ! -e "$diaryfile" ]; then
    date '+%Y/%m/%d' > "$diaryfile"
fi

vi "$diaryfile"