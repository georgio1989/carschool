<?php
class filer{
	protected $nev,$m,$buffer,$tartalom;
	
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
	
	public function GM(){
		return $this->m;
	}
	public function SM($m){
		$this->m=$m;
	}	
	public function GN(){
		return $this->nev;
	}
	public function SN($n){
		$this->nev=$n;
	}
	
	public function GT(){
		return $this->tartalom;
	}
	
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
	
	public function GB(){
		return $this->buffer.'<br/>';
	}
	public function SB($b){
		$this->buffer=$b;
	}
	
	public function merge(){
		$this->tartalom.=$this->buffer;
	}
	
	protected function hiba($ok){
		print $ok;
	}
}

class system {
	protected $status;
	
	public function __construct(){
		$this->status='AVAIBLE';
	}
	# Oldal futásának kényszerített megállítása, hibaüzenet kiírásával, a épés naplózásra kerül
	public function allj($reszletek){
		$this->naploz($reszletek);
		$this->hiba('Illegális művelet');
		die();
	}
	# Napló bejegyzést készít
	protected function naploz($reszletek){
		$naplo=new filer('./save/log.txt','w+');
		$ido=date('Y.m.d H:i:s');
		$str='
'.$ido.' > '.$_SESSION['user_id'].' @ '.$_SERVER['REMOTE_ADDR'].' >->'.$reszletek;
		$naplo->SB($str);
		print $naplo->GB();
		$naplo->ST();
	}
	# Hibaüzenet kidobása
	protected function hiba($ok){
		
	}
	
}



$sys=new system();
?>