<?php
//print "<pre>"; print_r($_REQUEST); print "</pre>"; 
//print "<pre>"; print_r($_SERVER); print "</pre>"; 

if(preg_match("#^.*/(.*)/(adm|cad)$#is", $_SERVER['REQUEST_URI'], $aux)){
	//print "<pre>"; print_r($aux); print "</pre>"; exit;
	include $aux[2].$aux[1].".php";
}

#include $_REQUEST['action'].$_REQUEST['classe'].".php";
#header("location: {$_REQUEST['action']}{$_REQUEST['classe']}.php?id={$_REQUEST['id']}");