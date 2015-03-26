<?php
require_once dirname(dirname(__FILE__))."/classes/class.ControleWeb.php";
 
$server = new SoapServer("service.wsdl"); 
$server->setClass('ControleWeb'); 

$server->handle(); 