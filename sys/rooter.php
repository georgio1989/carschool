<?php
# Base.php alap osztály
include 'include/base.php';
switch($G['site']['module']){
	case '':
		include '';
		break;
}
?>