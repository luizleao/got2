<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Post.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.PostMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.PostBDBase.php');

class PostBD extends PostBDBase{
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