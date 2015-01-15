<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Comentario.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ComentarioMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ComentarioBDBase.php');

class ComentarioBD extends ComentarioBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }
	
    
}