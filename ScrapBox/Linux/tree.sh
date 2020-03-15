#!/bin/bash

list_recursive ()
{
    local filepath=$1
    echo "$filepath"

    if [ -d "$filepath" ]; then
        #
        #
    fi
}

list_recrusive "$1"
