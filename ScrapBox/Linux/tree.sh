#!/bin/bash

list_recursive ()
{
    local filepath=$1
    echo "$filepath"

    if [ -d "$filepath" ]; then
        local fname 
        for fbname in $(ls "$filepath")
        do
            # ディレクトリ内のファイルを表示
            echo "${filepath}/${fname}"
        done
    fi
}

list_recrusive "$1"
