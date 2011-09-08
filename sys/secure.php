<?php

#GET,POST,SESSION alap szűrése a G tömbbe $G['g']->~get,$G['p']->~post,$G['s']->~session 
foreach($_GET as $k=>$i){
	$G['g'][$k]=addslashes(xss($_GET[$k]));
}
foreach($_POST as $k=>$i){
	$G['p'][$k]=addslashes(xss($_POST[$k]));
}
foreach($_SESSION as $k=>$i){
	$G['s'][$k]=addslashes(xss($_SESSION[$k]));
}

?>