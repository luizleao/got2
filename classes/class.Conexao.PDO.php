<?php
/**
 * Class ConexaoPDO | classes/Class.Conexao.PDO.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Classe de Conexão PDO
 * 
 * Possibilita a conexão com o banco de dados baseado na biblioteca PDO
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
class ConexaoPDO extends PDO{
    /**
     * Consulta executada
     * 
     * @var string 
     */
    public $consulta;  
    /**
     * Mensagem do sistema
     * 
     * @var string
     */
    public $msg;
    /**
     * Endereço do servidor
     * 
     * @var string
     */
    public $host;
    /**
     * Banco de dados selecionado
     * 
     * @var string 
     */
    public $db;
    /**
     * Usuário do banco
     * 
     * @var string 
     */
    public $user;
    /**
     * Senha do banco
     * 
     * @var string 
     */
    public $passwd;
    /**
     * Tipo de banco de dados
     * 
     * @var string 
     */
    public $sgbd;
    
    /**
     * Data de Cadastro Padrão
     * 
     * @var string 
     */
    public $data_cadastro_padrao;
    
    /**
     * Metodo construtor
     * 
     * @param string $sgbd
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $passwd
     * @return void
     */
    function __construct($sgbd, $host, $db, $user, $passwd){
        $this->sgbd   = $sgbd;
        $this->host   = $host;
        $this->db     = $db;
        $this->user   = $user;
        $this->passwd = $passwd;
        
        try {
            switch($this->sgbd){
                case "mysql": 
                    parent::__construct("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->passwd); 
                    $this->data_cadastro_padrao = "now()";
                break;
                
                case "sqlserver":
                    parent::__construct("sqlsrv:server=".$this->host.";database=".$this->db, $this->user, $this->passwd);
                break;
                
                case "pgsql":
                	parent::__construct("pgsql:host={$this->host} dbname={$this->db} user={$this->user} password={$this->passwd} port=5432");
                break;
            }
            
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
    
    /**
     * Executa uma instrução SQL do SGBD
     * 
     * @param string $sql
     * @return boolean
     */
    function execute($sql){
        try {
            $this->consulta = $this->query($sql);
            return true;	
        } catch (PDOException $e) {
            $this->msg = $e->getMessage();
            return false;
        }
    }
    
    /**
     * Executa uma instrução SQL do SGBD, utilizando prepare SQL
     * 
     * @param string $sql
     * @param string[] $aDados
     * @return boolean
     * @throws PDOException
     */
    function executePrepare($sql, $aDados=NULL) {			
        $this->consulta = $this->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if(!$this->consulta->execute($aDados)){
            $aErro = $this->consulta->errorInfo();
            //print_r($aErro);

            throw new PDOException($aErro[1]." - ".$aErro[2], $aErro[1]);
            //$this->msg = "Erro!!!";
        }
        return true;
    }
    
    /**
     * Retorna a quantidades de linhas afetadas pela Query
     * 
     * @param resource $consulta Consulta executada
     * @return int
     */
    function numRows($consulta = NULL){
        if(!$consulta){ 
            $consulta = $this->consulta;
        }
        return (int) $consulta->rowCount();
    }
    
    /**
     * Retorna os dados da consulta em forma de array
     * 
     * @param resource $consulta
     * @return string[]
     * @throws PDOException
     */
    function fetchReg($consulta = NULL){
        if($consulta != NULL){
            $this->consulta = $consulta;
        }
        if(!$this->consulta){
            print_r($this);
            $aErro = $this->consulta->errorInfo();
            
            throw new PDOException($aErro[1]." - ".$aErro[2], $aErro[1]);
        }
        return $this->consulta->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Retorna array de dados, indexado por indices e chaves
     * 
     * @param object $consulta
     * @return object
     */
    function fetchRow($consulta = NULL){
        if(!$consulta){
            $this->consulta = $consulta;
        }
        return $this->consulta->fetch();
    }
    
    /**
     * Retorna o último ID inserido em uma transação recente
     * 
     * @return int
     */
    function lastID(){
        return $this->lastInsertId();
    }
    
    /**
     * Fecha a conexão
     * 
     * @return void
     */
    function close(){
        if($this->consulta){
            $this->consulta->closeCursor();
        }
    }
    
    /**
     * Inicia a transação
     * 
     * @return void
     */
    function beginTrans(){
        $this->beginTransaction();	
    }
    
    /**
     * Conclui a transação
     * 
     * @return void
     */
    function commitTrans(){
        $this->commit();
    }

    /**
     * Cancela a transação
     * 
     * @return void
     */
    function rollBackTrans(){
        $this->rollBack();
    }
}