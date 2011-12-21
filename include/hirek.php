<?php
class hirek extends mod{
	
	# Jogosultság tároló ,0.tömbben szereplőkhöz 0-ás jogosultság vagy nagyobb kell,1esben 1es vagy nagyobb stb...	
	protected $jog=array(
		array('friss','arch'),		#0-ás jogosultság						  -
		array(),			#1es vagy 0ás jogosultság		   |-hívása esetén parent::jog($this->jog); true-t ad vissza ellenkező esetben
		array() 			#1es,2es vagy 0ás jogosultság -           ACCES DENIED hibaüzenet kidobása + die + naplózás
	);
	
	function __construct(){
		global $G;
		$this->tartalom=parent::pref();
		parent::setDef('friss');
	}
	function friss(){
		global $G;
		if(parent::jog($this->jog)){
			$contents='';
			$q=$G['db']->query('SELECT * FROM hirek WHERE status>0 limit 10');
			$r=$q->fetchAll();
			$n=$q->rowCount();
			foreach($r as $f){
				$sablon_hir=getElem('hir_item');
				$sablon_hir=str_replace('{id}',$f['id'],$sablon_hir);
				$sablon_hir=str_replace('{cim}',$f['cim'],$sablon_hir);
				$sablon_hir=str_replace('{tartalom}',$f['tartalom'],$sablon_hir);
				$nev=new felhasznalo('az',$f['szerzo']);
				$sablon_hir=str_replace('{szerzo}',$nev->GetTelj_nev(),$sablon_hir);
				$sablon_hir=str_replace('{mikor}',$f['mikor'],$sablon_hir);
				
				$contents.=$sablon_hir;
			}
		
			$foCim='Hírek';
			$this->tartalom=str_replace('{foCim}',$foCim,$this->tartalom);
			$this->tartalom=str_replace('{contents}',($n>0)?$contents:'Nincsen megjelenítendő hír!',$this->tartalom);
		}
	}
	function arch(){
		global $G,$SITE;
		if(parent::jog($this->jog)){
			$contents='';
			$q=$G['db']->query('SELECT * FROM hirek WHERE id="'.$SITE['param'].'"');
			$f=$q->fetch();
			$sablon_hir=getElem('hir_nezo');
			$sablon_hir=str_replace('{id}',$f['id'],$sablon_hir);
			$sablon_hir=str_replace('{tartalom}',$f['tartalom'],$sablon_hir);
			$nev=new felhasznalo('az',$f['szerzo']);
			$sablon_hir=str_replace('{szerzo}',$nev->GetTelj_nev(),$sablon_hir);
			$sablon_hir=str_replace('{mikor}',$f['mikor'],$sablon_hir);

			$foCim=$f['cim'];
			$this->tartalom=str_replace('{foCim}',$foCim,$this->tartalom);
			$this->tartalom=str_replace('{contents}',$sablon_hir,$this->tartalom);
		}
	}
}
$mod=new hirek();
?>