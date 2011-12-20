<?php
class user extends mod{
	
	protected $jog=array(
		array(),
		array('adatok'),
		array('reszletek'),
		array('admin')
	);
	
	function __construct(){
		global $G;	
		$this->tartalom=parent::pref();
		parent::setDef('asd');		
	}
	
	function adatok(){
		if(parent::jog($this->jog)){
			$dat=getElem('adatok');
			$u=new felhasznalo('az',$_SESSION['user_id']);
			$dat=str_replace('{nev}',$u->GetTelj_nev(),$dat);
			$dat=str_replace('{email}',$u->GetEmail(),$dat);
			$dat=str_replace('{telefon}',$u->GetTelefon(),$dat);
			$dat=str_replace('{cim}',$u->GetCim(),$dat);
			$dat=str_replace('{ll}',$u->GetUtolso_belepes(),$dat);
		
			$foCim='Adatok';
			$this->tartalom=str_replace('{foCim}',$foCim,$this->tartalom);
			$contents='Üdv az oldalon!';
			$this->tartalom=str_replace('{contents}',$dat,$this->tartalom);
		}
	}
	function reszletek(){
		if(parent::jog($this->jog)){
			print "haahahahahahahahahaha";
		}
	}
	function admin(){
		if(parent::jog($this->jog)){
			print "haahahahahahahahahaha";
		}
	}
}
$mod=new user();
?>