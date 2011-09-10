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


# visszaadja egy fájl által tartalmazott html kódot, azért praktikus fgv-t irni rá mert ha egyszer 
#		mysql-be átraknám a fájlok tartalmát csak a file_get_contents-t sql lekérdezésre kell modositani
function getElem($nev){
	$utvonal='./templates/'.$nev.'.tpl';
	$tartalom=file_get_contents($utvonal);
	return $tartalom;
}

# Jog int->str
function getJog($adat){
	switch($adat){
		case 1:
			$r='Diák';
			break;
		case 2:
			$r='Tanár';
			break;
		case 3:
			$r='Admin';
			break;
		case 4:
			$r='Admin';
			break;
		default:
			$r='Hibás jogosultság';
	}
	return $r;
}

?>