<?php
# A modulok őse, töle örökölnek sok support fgv-t
class mod {
	protected $tartalom,$jog;
	public function __construct() {
		global $G;
		$_SESSION['simple']=getElem('simple');
		$_SESSION['lab']=getElem('lab');
		$_SESSION['menu']=$this->createMenu();
		if($_SESSION['user_id']>0){
			$_SESSION['cetli']=getElem('cetli2');
			$_SESSION['cetli']=str_replace('{jog}',getJog($_SESSION['user_jog']),$_SESSION['cetli']);
			$_SESSION['cetli']=str_replace('{nev}',$_SESSION['user_nev'],$_SESSION['cetli']);
		}else{
			$_SESSION['cetli']=getElem('cetli');
		}
	}
	# Amennyiben vannak oldalsávban dobozok melyek relative függetlenek az menüpontoktól
	# 		azok ezzel lesznek fixálva
	function createMenu(){
		global $G;
		$vaz=getElem('menu');
		$item=getElem('item');
		$items='';
		$sth=$G['db']->query('SELECT * FROM menu WHERE jog<'.$_SESSION['user_jog'].' OR jog='.$_SESSION['user_jog']);
		$result = $sth->fetchAll();
		foreach($result as $r){
			$i=$item;
			$i=str_replace('{link}',$r['url'],$i);
			$i=str_replace('{nev}',$r['modulnev'],$i);
			if(strpos($r['url'],$G['site']['module'])!==false){
				$i=str_replace('{li_akt}','akt',$i);
				$i=str_replace('{a_akt}','aktual',$i);
			}else{
				$i=str_replace('{li_akt}','m',$i);
				$i=str_replace('{a_akt}','',$i);
			}
			$items.=$i;
		}
		$vaz=str_replace('{item}',$items,$vaz);
		return $vaz;
	}
	function WidgetIlleszt() {
		$this->tartalom=vIll($hirek,$this->tartalom);
	}
	# Default method set
	function setDef($m){
		global $G;
		if(strlen($G['site']['method'])==0 or $G['site']['method']=='' or !isset($G['site']['method'])){
			$G['site']['method']=$m;
		}
	}
	# A configban megszabott host url-re cseréli a templatek {getUrl}-jét
	function FixUrls() {
		global $G;
		$this->tartalom=str_replace('{getUrl}',$G['host'],$this->tartalom);
	}
	# Visszaadja a tartalmat
	function getTartalom() {
		return $this->tartalom;
	}
	# Cím formázó, ha megadunk  egy 2.ik paramétert olyan hosszuvá csonkitja ( végére ...-al jelöli a csonkítást),
	#		és alapból a kezdőbetűt nagybetűre transzformálja
	function title($par,$max_hosz='ul') {
		$par[0]=strtoupper($par[0]);
		$ujj='';
		if($max_hosz!='ul') {
			for($i=0;$i<$max_hosz;$i++) {
				if(!isset($par[$i])) {
					break;
				}
				$ujj.=$par[$i];
			}
			if($i==$max_hosz) {
				$ujj.='...';
				$par=$ujj;
			}
		}
		return $par;
	}
	# Kiírja a tartalmat
	function megjelenit() {
		$this->FixUrls($this->tartalom);
		print $this->tartalom;
	}
	# Az adott modul jogait kapja paraméterül, összeveti az aktuális felhasználó jogaival,
	# 	ha gebasz van naplóz és terel a hibaoldalra
	public function jog($jogok){
		global $G;
		$ok=false;
		for($i=0;$i<=$_SESSION['user_jog'];$i++){
			for($j=0;$j<count($jogok[$i]);$j++){
				if($jogok[$i][$j]==$G['site']['method']){
					$ok=true;
					break;
				}
			}
		}
		if($ok){
			return true;
		}else{
			global $sys;
			$sys->e('ACCES DENIED');
		}
	}
	# Összeilleszti az oldal elemeit
	public function pref(){
		$_SESSION['simple']=str_replace('{cetli}',$_SESSION['cetli'],$_SESSION['simple']);
		$_SESSION['simple']=str_replace('{menu}',$_SESSION['menu'],$_SESSION['simple']);
		$_SESSION['simple']=str_replace('{lab}',$_SESSION['lab'],$_SESSION['simple']);
		return $_SESSION['simple'];
	}
}
# Osztály példányosítása
$mod=new mod();
?>