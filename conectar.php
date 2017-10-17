<?php
require_once(dirname(__FILE__)."/classes/class.ControleWeb.php");
header('Content-type: text/json');
//echo json_encode($_REQUEST['sgbd']); exit;

switch($_REQUEST['sgbd']){
    case "mysql":
    	//$oConexao = new ConexaoMySql('Vazia');
    	$oConexao = new ConexaoMySqli('Vazia');
        $oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
    break;
    
    case "sqlserver":
        $oConexao = new ConexaoSqlServer('Vazia');
        $oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
    break;
    
    case "postgre":
    	$oConexao = new ConexaoPostgre('Vazia');
    	$oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
    break;
}

echo json_encode($oConexao->databases());