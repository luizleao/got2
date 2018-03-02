<?php
//include(dirname(__FILE__)."/classes/class.Util.php");
include(dirname(__FILE__)."/classes/class.Geracao.php");
//$oGeracao = new Geracao("xml/DBBADAM.xml");
//$oGeracao = new Geracao("xml/dbSudamSicas.xml");

//$a = $oGeracao->getCamposSelect('cliente');
//$a = $oGeracao->getCamposSelect("sicas_pessoa");
//$a = $oGeracao->getCamposArray("sicas_pessoa");

//$a = $oGeracao->getCamposSelect("reserva_servicotourico");
//$a = $oGeracao->getCamposSelect($_SERVER['argv'][1]);
//$a = $oGeracao->retornaArvore("sicas_servidor","SicasServidor");
//$a = $oGeracao->getTabelasJoin("sicas_pessoa");
//$b = $oGeracao->retornaObjetosMontados("sicas_pessoa");
//$a = $oGeracao->retornaTabelasFK("g_municipio");

//Util::trace($a);

//echo $oGeracao->converteTabelaCamposToString($a); 
//print "-->".$oGeracao->getTituloCombo("post"). "\n";
//print $oGeracao->getTituloCombo("sicas_lotacao"). "\n";
//print_r($b);
/*
$database = new stdClass();
$database->nome = "blog";
$database->sgbd = "mysql";
$database->user = "root";
$database->senha = "root";
$database->aTabela[0] = (object) NULL;
$database->aTabela[0]->nome = 'post';
$database->aTabela[0]->schema = '';
$database->aTabela[0]->tipo_tabela = 'NORMAL';
$database->aTabela[0]->aCampo[0] = (object) NULL;
$database->aTabela[0]->aCampo[0]->nome = 'idPost';
$database->aTabela[0]->aCampo[0]->tipo = 'int(10) unsigned';
$database->aTabela[0]->aCampo[0]->nulo = 'NO';
$database->aTabela[0]->aCampo[0]->chave = '1';
$database->aTabela[0]->aCampo[0]->fktabela = '';
$database->aTabela[0]->aCampo[0]->fkcampo = '';


//CAMPO NOME="idComentario" TIPO="int(10) unsigned" NULO="NO" CHAVE="1" FKTABELA="" FKCAMPO=""
Util::trace($database);

echo json_encode($database);
*/