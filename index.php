<?php

include 'sys/config.php';

function kiir(){
	global $G;
	print '<pre>';
	print_r($G);
	print '</pre>';
}
kiir();
?>