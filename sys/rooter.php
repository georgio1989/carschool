<?php
# Base.php alap osztály
include 'include/base.php';

include './include/'.$G['site']['module'].'.php';


//error always !false
if(!@call_user_func(array($mod,$G['site']['method']))){
	//@call_user_func(array('mod','e404'));
}
?>