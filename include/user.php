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
	}
	
	function adatok(){
		if(parent::jog($this->jog)){
		$u=new felhasznalo('az',$_SESSION['user_id']);
		$nev=$u->GetTelj_nev;
		$email=$u->GetEmail();
		$telefon=$u->GetTelefon();
		$cim=$u->GetCim();
		$ubejel=$u->GetUtolso_belepes();
		
		vIll()
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