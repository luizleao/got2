<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

foreach($_POST as $campo=>$valor){
    $$campo = trim($valor);
}
$oControle = new Controle();

print ($oControle->autenticaUsuarioLDAP($login, $senha)) ? "" : $oControle->msg;
