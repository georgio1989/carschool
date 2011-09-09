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
}
# Osztály példányosítása
$mod=new mod();
?>