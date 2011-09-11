<?php
# Base.php alap osztály
include 'include/base.php';

if(!@include './include/'.$G['site']['module'].'.php'){ // ./include/modulnev.php beemelése
	$sys->e(404);																				 // 	  hiba esetén 404es hiba dobása + naplózás
}

@call_user_func(array($mod,$G['site']['method']));			// site/modul/methódus/params -> modul->methódus hívás

?>