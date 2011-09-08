<?php
# XSS támadás kivédése és naplózása
function xss($string){
	global $sys;
	$s=strtolower($string);
	$p=strpos($s,'script');
	if($p===false){
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}else{
		$sys->allj('XSS esélyes:'.$string);
	  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}


?>