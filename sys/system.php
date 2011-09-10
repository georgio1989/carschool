<?php
# Fájlműveletek lekezelésének megkönnyítője
class filer{
	protected $nev,$m,$buffer,$tartalom;
	
	# Ha nem adunk meg megnyitási módot akkor alapból r+w+a lessz
	public function __construct($nev,$m='a'){
		$this->m=$m;
		$this->nev=$nev;
		$this->buffer='';
		if($this->m!='w+'){
			if(!$this->tartalom=file_get_contents($nev)){
				$this->hiba('Helytelen fájlnév/elérési útvonal');
			}
		}
	}
	# GetMod
	public function GM(){
		return $this->m;
	}
	# SetMod
	public function SM($m){
		$this->m=$m;
	}	
	# GetNev
	public function GN(){
		return $this->nev;
	}
	# SetNev
	public function SN($n){
		$this->nev=$n;
	}
	# GetTartalom
	public function GT(){
		return $this->tartalom;
	}
	# SetTartalom(=írás fájlba)
	# 	a:writable,append		r:fail->readonly	w:ok,felülir minden eddigit,	w+:ok,write,append
	public function ST($b=false){
		if($b){
			$this->merge();
		}
		if($this->m=='a'){
			if(!file_put_contents($this->nev,$this->tartalom, FILE_APPEND)){
			}
		}
		if($this->m=='r'){
			$this->hiba('A fájl csak olvasásra lett megnyitva');
		}
		if($this->m=='w'){
			file_put_contents($this->nev,$this->tartalom);
		}
		if($this->m=='w+'){
			file_put_contents($this->nev,$this->buffer,FILE_APPEND);
		}
	}
	# GetBuffer
	public function GB(){
		return $this->buffer.'<br/>';
	}
	# SetBuffer
	public function SB($b){
		$this->buffer=$b;
	}
	# Buffer tartalommal eggyesítése
	public function merge(){
		$this->tartalom.=$this->buffer;
	}
	# Hiba szövegének átadása
	protected function hiba($ok){
		return $ok;
	}
}

class system {
	protected $status;
	
	public function __construct(){
		$this->status='AVAIBLE';
	}
	# Napló bejegyzést készít
	public function naploz($reszletek){
		//if(!$reszletek=='Nem létező link :static'){
			$naplo=new filer('./save/log.txt','w+');
			$ido=date('Y.m.d H:i:s');
			$str='
'.$ido.' > '.$_SESSION['user_id'].' @ '.$_SERVER['REMOTE_ADDR'].' >->'.$reszletek;
			$naplo->SB($str);
			$naplo->ST();
		//}
	}
	# Hibaüzenet kidobása
	protected function hiba($ok){
		
	}
	# Error handler
	public function e($cim,$egyeb=''){
	global $sys,$G;

	switch($cim){
		case 'ACCES DENIED':
			$this->naploz('Alacsonyabb jogosultság:'.$G['site']['module'].'/'.$G['site']['method']);
			$ok='A kívánt művelethez nem elég a jogosultsága!';
			break;
		case '404':
			$this->naploz('Nem létező link :'.$G['site']['module']);
			$ok='Nem létező webcímet próbál megjeleníteni!';
			break;
		case 'XSS':
			$this->naploz('XSS gyanus :'.$egyeb);
			$ok='Illegális művelet';
			break;
		default:
			$ok='Ooops Ismeretlen hiba';
	}

	//kill , hiba templatre illesztés
	print $cim.' : '.$ok;	
	}
}

$sys=new system();
?>