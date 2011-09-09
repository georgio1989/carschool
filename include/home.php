<?php
class home extends mod{
	
	# Jogosultság tároló ,0.tömbben szereplőkhöz 0-ás jogosultság vagy nagyobb kell,1esben 1es vagy nagyobb stb...	
	protected $jog=array(
		array('asd'),
		array()
	);
	
	function __construct(){
		global $G;		
	}
	function asd(){
		
		print "haahahahahahahahahaha";
	}
}
$mod=new home();
?>