#!/bin/bash

print_parameters ()
{
    echo "\$1 = $1"
    echo "\$2 = $2"
    echo "\$3 = $3"
    echo "\$4 = $4"
    echo
    echo "$# arguments"
    echo "script name = $0"
}

print_parameters aaa bbb ccc