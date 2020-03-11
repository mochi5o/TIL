<?php
session_start();
var_dump($_SESSION['adstxt']);
$text = $_POST['ads'] .','. $_POST['pubid'] .',' .$_POST['type'] .','.$_POST['user'];
$id = (int)$_SESSION['id'];
var_dump($_SESSION['adstxt'][$id]);

$_SESSION['adstxt'][$id] = $text;
//    array_splice( $_SESSION['adstxt'], $id, 0, $text );

var_dump($_SESSION['adstxt']);
