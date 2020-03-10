<?php
session_start();
var_dump($_SESSION['adstxt']);
$text = $_POST['ads'] .','. $_POST['pubid'] .',' .$_POST['type'] .','.$_POST['user'];
$id = $_SESSION['id'];
array_splice( $_SESSION['adstxt'], $id, 0, $text )
[$id] = $text;
var_dump($_SESSION['adstxt']);
