<?php
session_start();
$_SESSION['user_id']=10;
$_POST['asd']='asdsada';
include 'sys/system.php';
include 'sys/functions.php';
include 'sys/secure.php';
include 'sys/config.php';
function kiir(){
	global $G;
	print '<pre>';
	print_r($G);
	print '</pre>';
}
kiir();
?>