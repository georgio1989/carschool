<?php
session_start();
$_POST['logout_gomb']= 'ok';
//  $_POST['user_nev']= 'n_bela';
//  $_POST['user_jsz']='n_bela' ;
include 'sys/system.php';
include 'sys/functions.php';
include 'sys/secure.php';
include 'sys/config.php';
include 'sys/logger.php';
include 'sys/rooter.php';
function kiir(){
	global $G;
	print '<pre>';
	print_r($G);
	print '</pre>';
}
print $_SESSION['user_id'];
kiir();
?>