<?php
class mod {
	protected $tartalom,$jog;
	public function __construct() {
		global $G;
		
		$this->tartalom='';
	}
	function WidgetIlleszt() {
		$this->tartalom=vIll($hirek,$this->tartalom);
	}
	function FixUrls() {
		global $G;
		$this->tartalom=str_replace('{getUrl}',$G['host'],$this->tartalom);
	}
	function getTartalom() {
		return $this->tartalom;
	}
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
	function megjelenit() {
		print $this->tartalom;
	}
	function e404(){
		print "A keresett oldal nem található!";
		global $sys,$G;
		$sys->naploz('Nem létező link :'.$G['site']['module']);
		$sys->e(404,'Nem létező webcímet próbál megjeleníteni!');
	}
	public function jog($jogok){
		global $G;
		$ok=false;
		print count($jogok[$_SESSION['user_jog']]);
		for($i=0;$i<=$_SESSION['user_jog'];$i++){
			for($j=0;$j<count($jogok[$_SESSION['user_jog']]);$j++){
				if($jogok[$_SESSION['user_jog']][$j]==$G['site']['method']){
					$ok=true;
					print $jogok[$_SESSION['user_jog']][$j].'---'.$G['site']['method'].'<br/>';
					break;
				}
			}
		}
		if($ok){
			return true;
		}else{
			global $sys,$G;
			$sys->naploz('Alacsonyabb jogosultság:'.$G['site']['module'].'/'.$G['site']['method']);
			$sys->e('ACCES DENIED','A kívánt művelethez nem elég a jogosultsága!');
		}
	}
}
# Osztály példányosítása
$mod=new mod();
?>