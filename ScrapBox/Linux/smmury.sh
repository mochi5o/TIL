#!/bin/bash

# 引数で指定されたパスは通常ファイルなのかディレクトリなのかを表示する
# ディレクトリであればその中に含まれているファイル一覧を表示する
# 通常のファイルであればファイルの先頭5行を表示する

# 引数で渡されたファイルを変数に格納
file=$1
# ファイルの種類を調べる
if [ -d "$file" ]; then
  echo "$file is a directory"
  ls "$file"
elif [ -f "$file" ]; then
  echo "$file is a regular file"
  head -n 5 "$file"
fi