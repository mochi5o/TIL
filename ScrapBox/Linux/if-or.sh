#!/bin/bash

str=$1
if [ "$str" = 'home' ] || [ "$str" = 'usr' ]; then
  echo "str = home or str = usr"
fi