<?php
//include(dirname(__FILE__)."/classes/class.Util.php");
include(dirname(__FILE__)."/classes/class.Geracao.php");
$oGeracao = new Geracao("xml/DBBADAM.xml");
//$oGeracao = new Geracao("xml/blog.xml");

//$a = $oGeracao->getCamposSelect('cliente');
//$a = $oGeracao->getCamposSelect("usuariogrupo");
//$a = $oGeracao->getCamposSelect("reserva_servicotourico");
//$a = $oGeracao->getCamposSelect($_SERVER['argv'][1]);
//$a = $oGeracao->retornaArvore("sicas_cid");
//$a = $oGeracao->getTabelasJoin("sicas_pessoa");
//$b = $oGeracao->retornaObjetosMontados("sicas_pessoa");
//$a = $oGeracao->retornaTabelasFK("g_municipio");

//print_r($a);

print "-->".$oGeracao->getTituloCombo("g_municipio"). "\n";
//print $oGeracao->getTituloCombo("sicas_lotacao"). "\n";
//print_r($b);

