<?php
# Base.php alap oszt�ly
include 'include/base.php';
switch($G['site']['module']){
	case '':
		include '';
		break;
}
?>