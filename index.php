<?php
session_start();
$_SESSION['user_id']=10;
$_SESSION['user_jog']=10;
$_POST['asd']='asdsada';
include 'sys/system.php';
include 'sys/functions.php';
include 'sys/secure.php';
include 'sys/config.php';
include 'sys/rooter.php';
function kiir(){
	global $G;
	print '<pre>';
	print_r($G);
	print '</pre>';
}
kiir();
?>