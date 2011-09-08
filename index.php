<?php
print_r($_SERVER['REQUEST_URI']);
$url=@explode('/',$_SERVER['REQUEST_URI']);
$SITE['module']=$url[2];
$SITE['method']=$url[3];
$SITE['param']=@explode('__',$url[4]);
print '<pre>';
print_r($SITE);
print '</pre>';
?>