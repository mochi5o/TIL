#!/bin/bash

homesize ()
{
    date
    du -h ~ | tail -n 1
}

# 定義した関数を呼び出しておく
homesize