<?php
/**
 * Class DiretorioXML | classes/Class.DiretorioXML.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Diretorios XML
 * 
 * Gerencia a lista de arquivos XML gerados pela aplicação
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
class DiretorioXML {
    /**
     * Lista de arquivos XML
     * 
     * @var string[] 
     */
    public $arquivos;

    /**
     * Método Construtor
     * 
     * @return void
     */
    function __construct(){
        $arquivos = array();
        $dir      = dirname(__FILE__)."/../xml/";
        $dh       = opendir($dir);
        while(($file = readdir($dh)) !== false){
            if(filetype($dir.$file) == "file" && substr($file,-4) == ".xml"){
                $arquivos[] = substr($file,0,strrpos($file,".xml"));
            }
        }
        $this->arquivos = $arquivos;
    }
    
    /**
     * Método GET
     * 
     * @return string[] 
     */
    function get_arquivos(){
        return $this->arquivos;
    }

    /**
     * Método SET
     * 
     * @param string[] $arquivos Lista de arquivos do diretório
     */
    function set_arquivos($arquivos){
        $this->arquivos = $arquivos;
    }
}