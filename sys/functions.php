<?php
# XSS támadás kivédése és naplózása
function xss($string){
	global $sys;
	$s=@strtolower($string);
	$p=strpos($s,'script');
	if($p===false){
		return @htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}else{
		$sys->e('XSS',$string);
	  return @htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}

# Base source http://us2.php.net/manual/en/language.variables.php#49997;
#		vIll($valtozo,$miben)-> {valtozo}-t lecseréli a $valtozo tartalmára és visszatér a $miben-el
function vIll(&$var, $hol, $scope=false, $prefix='unique', $suffix='value')
{
	$mire=$var;
	if($scope){
		$vals = $scope;
	}
	else{
		$vals = $GLOBALS;
	}
	$old = $var;
	$var = $new = $prefix.rand().$suffix;
	$vname = FALSE;
	foreach($vals as $key => $val) {
		if($val === $new){
			$vname = $key;
		}
	}
	$var = $old;
	$mit='{'.$vname.'}';
	$hol=str_replace($mit,$mire,$hol);
	return $hol;
}

# visszaadja egy fájl által tartalmazott html kódot, azért praktikus fgv-t irni rá mert ha egyszer 
#		mysql-be átraknám a fájlok tartalmát csak a file_get_contents-t sql lekérdezésre kell modositani
function getElem($nev){
	$utvonal='./templates/'.$nev.'.tpl';
	$tartalom=file_get_contents($utvonal);
	return $tartalom;
}

?>