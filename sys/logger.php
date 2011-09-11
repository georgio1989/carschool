<?php
#Készítette: Szöllősi György

/* 
 * Vendég osztály definiálása, alapértelmezett jogosultsággal rendelkezik (0)
 */
class vendeg {
	protected $felh_nev,$jog,$azon;
	function  __construct() {
			$this->jog=0;
			$this->azon=0;
			$this->felh_nev='vendeg';
	}
	# Új felhasználó regisztrálása
	function Felhaszn_reg($felh_nev,$jsz,$jog,$telj_nev,$email,$telefon,$telepules,$utca_hsz) {
		global $G;
		$kukac=false;
		$pont=false;
		for($i=0;$i<strlen($email);$i++) {
			if($email[$i+1]=='@') {
				$kukac=$i;
			}
			if($email[$i]=='.') {
				$pont=$i;
			}
		}
		# Adatok ellenörzése
		$j_adat=0;
		if(strlen($felh_nev)>5) {
			$j_adat++;
		}else {
			$hiba[]='Túl rövid felhasználónév!';
		}
		if(strlen($jsz)>5) {
			$jsz=md5($jsz);
			$j_adat++;
		}else {
			$hiba[]='Túl rövid jelszó!';
		}
		if(($kukac!==false && $pont!==false)&& ($kukac+3<=$pont) && (strlen($email)-$pont>=2) && ($pont>$kukac)) {
			$email=tisztit($email);
			$j_adat++;
		}else {
			$hiba[]='Érvénytelen e-mail cím!';
		}
		if(is_numeric($telefon)) {
			$j_adat++;
		}else {
			$hiba[]='Érvénytelen telefonszám!';
		}
		if($j_adat==4) {
			$sth=$G['db']->prepare("INSERT INTO felhasznalok VALUES ('',?,?,?,?,?,?,?,?,'')");
			$d=$sth->execute(array($felh_nev,$jsz,$jog,$telj_nev,$email,$telefon,$telepules,$utca_hsz));
			if($d){
				return 'Sikeres regisztráció!';
			}else{
				return 'Sikertelen regisztráció!';
			}
		}
		# Hibák megjelenítése
		else {
			return $hiba;
		}
	}
	function GetFelh_nev() {
			return $this->felh_nev;
	}
	# Ellenőrzi hogy elérhetó e a felhasználónév
	function NevSzabade($adat) {
		global $G;
		$sth=$G['db']->prepare("SELECT count(felhaszn_nev)as fh FROM felhasznalok WHERE felhaszn_nev=?");
		$d=$sth->execute(array($adat));
		$felhasznalok= $sth->fetch();
		if($felhasznalok['fh']>0) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	# Jelszót ellenőriz
	function JszEllen($jsz,$fh_nev) {
		global $G;
		$jsz=md5($jsz);
		$sth=$G['db']->prepare('SELECT * FROM felhasznalok WHERE felhaszn_nev=?');
		$d=$sth->execute(array($fh_nev));
		$felhasznalok= $sth->fetch();
		if($felhasznalok['jelszo']==$jsz) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	# Jog visszaadása
	function GetJog() {
		return $this->jog;
	}
	# Get Azon
	function GetAzon() {
			return $this->azon;
	}
}

class felhasznalo extends vendeg {
	protected $telj_nev,$email,$telefon,$cim,$utolso_belepes,$telep,$hazszam;

#Felhasználó adatait lekérdező fügvény;
	function  __construct($min,$ertek) {
		global $G;

		if($min=='az') {
			$sth=$G['db']->prepare('SELECT * FROM felhasznalok WHERE azonosito=?');
			$d=$sth->execute(array($ertek));
		}
		else if($min=='nev') {
			$sth=$G['db']->prepare('SELECT * FROM felhasznalok WHERE felhaszn_nev=?');
			$d=$sth->execute(array($ertek));
		}
		$felhasznalok= $sth->fetch();
		
		$this->azon=$felhasznalok['azonosito'];
		$this->felh_nev=$felhasznalok['felhaszn_nev'];
		$this->jog=$felhasznalok['jog'];
		$this->telj_nev=$felhasznalok['teljes_nev'];
		$this->email=$felhasznalok['email'];
		$this->telefon=$felhasznalok['telefon'];
		$this->cim=$felhasznalok['telepules']." ".$felhasznalok['utca_hsz'];
		$this->telep=$felhasznalok['telepules'];
		$this->hazszam=$felhasznalok['utca_hsz'];
		$this->utolso_belepes=$felhasznalok['utolso_belepes'];
		
	}
#Felhasználó adatainak egyesével történő módosítását biztosító fgv blokk
	function SetAdat($par,$adat) {
		global $G;
		if($par!='jelszo') {
			$sth=$G['db']->prepare('UPDATE felhasznalok SET ?=? WHERE felhaszn_nev=?');
			$d=$sth->execute(array($par,$adat,$this->felh_nev));
			if($d) {
				$this->Refresh();
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}
#Jelszó módosító fgv//////////////////////////////////////////////////////////////////////////////////////////
	function SetJelszo($adat) {
			$jelszo=md5($adat);
			$sql="UPDATE felhasznalok SET jelszo='$jelszo' WHERE felhaszn_nev='$this->felh_nev'";
			$mod=mysql_query($sql);
			$sth=$G['db']->prepare('UPDATE felhasznalok SET jelszo=? WHERE felhaszn_nev=?');
			$d=$sth->execute(array($jelszo,$this->felh_nev));
			if($mod) {
					$this->Refresh();
					return TRUE;
			}
			else {
					return 'Hiba : '.mysql_error();
			}
	}
	function Refresh() {
			$this->__construct('az',$this->azon);
	}
#Felhasználó adatainak egyesével történő elérését biztosító fgv blokk
	function GetTelj_nev() {
			return $this->telj_nev;
	}
	function GetEmail() {
			return $this->email;
	}
	function GetTelefon() {
			return $this->telefon;
	}
	function GetCim() {
			return $this->cim;
	}
	function GetUtolso_belepes() {
			return $this->utolso_belepes;
	}
	function GetTelep() {
			return $this->telep;
	}
	function GetHazszam() {
			return $this->hazszam;
	}
}

if(isset($G['p']['logout_gomb'])) {
	$sys->naploz('LOGGED OUT :'.$_SESSION['user_id']);
	unset($_SESSION['user_jog']);
	unset($_SESSION['user_id']);
	include './sys/secure.php';
}

# Login form kitöltésekor megy bele az if ágba
if(isset($G['p']['login_gomb'])) {
	# Amenyiben még nincs beálítva munkamenet: létrehozásra kerül vendég jogosultságokkal
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id']==0) {
		$user=new vendeg();
		# Amenyiben érvényes adatokkal bejelentkezik valaki, munkamenet beállítodik az adatainak megfelelően
		if($user->JszEllen($G['p']['user_jsz'],$G['p']['user_nev'])) {
			$user=new felhasznalo('nev',$G['p']['user_nev']);
			$user->refresh();
			$_SESSION['user_jog']=$user->GetJog();
			$_SESSION['user_nev']=$user->GetFelh_nev();
			$_SESSION['user_id']=$user->GetAzon();
			$_SESSION['ido']=date('Y.m.d H:i:s');
			include './sys/secure.php';
			$sys->naploz('LOGGED IN :'.$_SESSION['user_id']);
			$_SESSION['login_fail']=0;
		}
		# Amenyiben hibás adatokat adott meg hiba tömbbe bekerül a hibaüzenet amit az ertesit.php jelenit meg
		else {
			$hiba[]=" Hibás felhasználónév vagy jelszó!";
			$sys->e('LOGIN FAIL');
		}
	}
	# Amenyiben a login formra kerül egy már bejelentkezett felhasználó
	else {
		$user=new felhasznalo('az',$_SESSION['user_id']);
	}
}
# Amenyiben már van egy aktív munkamenet
else if(isset($_SESSION['user_id'])) {
	$user=new felhasznalo('az',$_SESSION['user_id']);
}
# Amenyiben először éri el az oldalt a eflhasználó: létrehozásra kerül vendég jogosultságokkal
else {
	$user=new vendeg();
	$_SESSION['user_jog']=$user->GetJog();
	$_SESSION['user_nev']=$user->GetFelh_nev();
	$_SESSION['user_id']=$user->GetAzon();
	$_SESSION['ido']=date('Y.m.d H:i:s');
	include './sys/secure.php';
	
	$sys->naploz('CONNECTED AS:'.$_SESSION['user_nev']);
}

?>