<?php
# Base.php alap osztály
include 'include/base.php';

if(!@include './include/'.$G['site']['module'].'.php'){
	$sys->e(404);
}

@call_user_func(array($mod,$G['site']['method']));

?>