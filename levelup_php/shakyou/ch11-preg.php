<?php

// 複数行の文字列
$str = "
Wagahai ha
Neko de aru
";

/**
 * 終端判定の＄
 * 複数行モードにする、を表すmを入れるとマッチする
 */

// マッチしない
var_dump(preg_match('/ha$/', $str));  // 0
// マッチする
var_dump(preg_match('/ha$/m', $str));  // 1

/**
 * 複数行モードに左右されない終端判定＝\Z と \z
 * \Z : 検索対象文字列の終端もしくは終端の改行（複数行モードとは独立）
 * \z : 検索対象文字列の終端（複数行モードとは独立）
 */

// マッチしない（終端以外マッチしない）
var_dump(preg_match('/ha\Z/m', $str));  // 0
// マッチする（終端の改行を終端と検知するのでマッチする）
var_dump(preg_match('/aru\Z/m', $str));  // 1
// マッチしない（改行が終端扱いされないのでマッチしない）
var_dump(preg_match('/aru\z/m', $str));  // 0
// マッチする（終端の改行にマッチした）
var_dump(preg_match('/\n\z/m', $str));  // 1