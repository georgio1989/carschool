<?php
session_start();
include './templates/header.html';
/*$_POST['login_gomb']= 'ok';
  $_POST['user_nev']= 'n_bela';
  $_POST['user_jsz']='n_bela' ;*/
include 'sys/system.php';
include 'sys/functions.php';
include 'sys/secure.php';
include 'sys/config.php';
include 'sys/logger.php';
include 'sys/rooter.php';
$mod->megjelenit();
function kiir(){
	global $G;
	print '<pre><font style="color:black">';
	print_r($G);
	print '</pre>';
}
//kiir();
?>