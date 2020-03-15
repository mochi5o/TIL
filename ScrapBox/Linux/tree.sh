#!/bin/bash

list_recursive ()
{
    local filepath=$1
    echo "$filepath"

    if [ -d "$filepath" ]; then
        local fname
        for fname in $(ls "$filepath")
        do
            list_recursive "${filepath}/${fname}"
            echo "${filepath}/${fname}"
        done
    fi
}


list_recrusive "$1"
