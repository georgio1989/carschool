<?php
class mod {
	protected $tartalom;
	public function __construct() {
		global $G;
		
		$this->tartalom='';
	}
	function WidgetIlleszt() {
		$this->tartalom=str_replace('{hirek}',$_SESSION['site_hirek'],$this->tartalom);
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
}
# Oszt�ly p�ld�nyos�t�sa
$mod=new mod();
?>