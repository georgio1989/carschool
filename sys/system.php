<?php
# Fájlműveletek lekezelésének megkönnyítője
require_once "./sys/config.php";
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
		print '<hr />'.$ok.'<hr />';
	}
}

class system {
	protected $status;
	
	public function __construct(){
		$this->status='AVAIBLE';
	}
	# Napló bejegyzést készít
	public function naploz($reszletek){
		//if(!$reszletek=='Nem létező link :img'){
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
		global $sys,$G,$fw;

		switch($cim){
			case 'ACCES DENIED':
				$this->naploz('Alacsonyabb jogosultság:'.$G['site']['module'].'/'.$G['site']['method']);
				$ok='A kívánt művelethez nem elég a jogosultsága!';
				break;
			case 'LOGIN FAIL':
				$_SESSION['login_fail']=(isset($_SESSION['login_fail']))?$_SESSION['login_fail']+1:1;
				$this->naploz('LOGGING IN FAIL WRONG PASS/USERNAME :'.$G['p']['user_nev']." @~>".$_POST['user_nev'].' 3/'.$_SESSION['login_fail'].' try');
				$ok='Helytelen felhasználónév/jelszó!<br/>3/'.$_SESSION['login_fail'].' próba!';
				if($_SESSION['login_fail']==3){
					$fw->bann();
					$_SESSION['login_fail']=0;
				}
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
		$site=getElem('simple');
		$sablon=getElem('error');
		$sablon=str_replace('{hiba_cim}',$cim,$sablon);
		$sablon=str_replace('{hiba_leiras}',$ok,$sablon);
		$site=str_replace('{hiba_leiras}',$ok,$site);
		$site=str_replace('{foCim}','Hiba!',$site);
		$site=str_replace('{contents}',$sablon,$site);
		$site=str_replace('{cetli}',$_SESSION['cetli'],$site);
		$site=str_replace('{menu}',$_SESSION['menu'],$site);
		$site=str_replace('{lab}',$_SESSION['lab'],$site);
		$site=str_replace('{getUrl}',$G['host'],$site);
		print $site;
		die();
	
	}
}

class fw{
	protected $status,$time;
	function __construct(){
		global $G;
		$q=$G['db']->query('SELECT * FROM bann WHERE ip="'.$_SERVER['REMOTE_ADDR'].'" ');
		$t=$q->rowCount();
		if($t>0){
			$reszletek=$q->fetch();
			if(($reszletek['time']+300)<time()){
				$this->disBann();
			}else{
				$this->status='BANNED';
				$this->time=$reszletek['time'];
			}
		}else{
			$this->status='NO';
		}
	}
	function Bann(){
		global $G;
		$q=$G['db']->prepare('INSERT INTO bann VALUES("",?,?,?)');
		$q->execute(array(time(),$_SERVER['REMOTE_ADDR'],'t'));
		$this::__construct();
	}
	function disBann(){
		global $G;
		$q=$G['db']->prepare('DELETE FROM bann WHERE ip=?');
		$q->execute(array($_SERVER['REMOTE_ADDR']));
		$this::__construct();
	}
	function getStatus(){
		return $this->status;
	}
	function meg(){
		$x=(300-(time()-$this->time));
		$s=$x%60;
		$perc=$x/60;
		$perc=explode('.',$perc);
		$p=$perc[0];
		return $p.' : '.$s;
	}
}

$sys=new system();
?>