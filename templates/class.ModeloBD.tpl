<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.%%NOME_CLASSE%%.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.%%NOME_CLASSE%%MAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.%%NOME_CLASSE%%BDBase.php');

class %%NOME_CLASSE%%BD extends %%NOME_CLASSE%%BDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }
	
    %%COMPLEMENTO%%
}