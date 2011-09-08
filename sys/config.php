<?php
# Adatbázis kapcsolatra vonatkozó beállítások
$DB['host']='localhost';
$DB['user']='root';
$DB['pass']='root';
$DB['db']='autosiskola';
$DB['charset']='UTF8';
$db=new PDO('mysql:host='.$DB['host'].';dbname='.$DB['db'], $DB['user'], $DB['pass']);
$db->query('SET NAMES '.$DB['charset']);

# Hostra vonatkozó beállítások, SITE tömb feltöltése
$url=@explode('/',$_SERVER['REQUEST_URI']);
$HOST='http://'.$_SERVER['HTTP_HOST'].'/'.$url[1].'/';
$SITE['module']=$url[2];
$SITE['method']=$url[3];
$param=@explode('__',$url[4]);
if(count($param)>1){
	$SITE['param']=$param;
}else{
	$SITE['param']=$url[4];
}

// G tömb létrehozás -> egy változó globalizálásával összes fontos változó elérhető lessz
$G['db']=$db;
$G['site']=$SITE;
$G['host']=$HOST;
?>