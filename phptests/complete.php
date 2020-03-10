<?php
session_start();
var_dump($_SESSION['adstxt']);
$text = $_POST['ads'] .','. $_POST['pubid'] .',' .$_POST['type'] .','.$_POST['user'];
$id = $_SESSION['id'];
var_dump($_SESSION['adstxt'][$id]);
var_dump($id);
$id = (int) $id;
var_dump($id);

$_SESSION['adstxt'][$id] = $text;
var_dump($_SESSION['adstxt'][$id]);
//    array_splice( $_SESSION['adstxt'], $id, 0, $text );

var_dump($_SESSION['adstxt']);
