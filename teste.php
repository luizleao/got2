<?php
//include(dirname(__FILE__)."/classes/class.Util.php");
include(dirname(__FILE__)."/classes/class.Geracao.php");
$oGeracao = new Geracao("xml/dbSudamSicas.xml");

//$a = $oGeracao->getCamposSelect('cliente');
//$a = $oGeracao->getCamposSelect("usuariogrupo");
//$a = $oGeracao->getCamposSelect("reserva_servicotourico");
//$a = $oGeracao->getCamposSelect($_SERVER['argv'][1]);
//$a = $oGeracao->retornaArvore("sicas_cid");
//$a = $oGeracao->getTabelasJoin("sicas_pessoa");
//$b = $oGeracao->retornaObjetosMontados("sicas_pessoa");
//$a = $oGeracao->retornaTabelasFK("sicas_pessoa");

//print_r($a);

//print $oGeracao->getTituloCombo("sicas_pessoa"). "\n";
//print $oGeracao->getTituloCombo("sicas_lotacao"). "\n";
//print_r($b);

$a = mysql_connect('localhost','root','root');
echo get_resource_type($a) . "\n";
mysql_select_db('blog');

$b = mysql_query('select * from post');
echo get_resource_type($b) . "\n";
