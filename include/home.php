<?php
class home extends mod{
	
	# Jogosultság tároló ,0.tömbben szereplőkhöz 0-ás jogosultság vagy nagyobb kell,1esben 1es vagy nagyobb stb...	
	protected $jog=array(
		array('asd'),	#0-ás jogosultság						  -
		array(),			#1es vagy 0ás jogosultság		   |-hívása esetén parent::jog($this->jog); true-t ad vissza ellenkező esetben
		array() 			#1es,2es vagy 0ás jogosultság -           ACCES DENIED hibaüzenet kidobása + die + naplózás
	);
	
	function __construct(){
		global $G;		
	}
	function asd(){
		if(parent::jog($this->jog)){
			print "haahahahahahahahahaha";
		}
	}
}
$mod=new home();
?>