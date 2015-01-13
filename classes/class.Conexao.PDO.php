<?php
/**
 * Classe de conexao com o banco de dados baseado na biblioteca PDO
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
     * @var type 
     */
    public $passwd;
    /**
     * Tipo de banco de dados
     * 
     * @var string 
     */
    public $sgbd;
    
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
                break;
                case "sqlserver": 
                    parent::__construct("sqlsrv:server=".$this->host.";database=".$this->db, $this->user, $this->passwd); 
                break;
            }
            
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
    
    /**
     * 
     * @param type $sql
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
     * 
     * @param type $sql
     * @param type $aDados
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
     * 
     * @param type $consulta
     * @return type
     */
    function numRows($consulta = NULL){
        if(!$consulta){ 
            $consulta = $this->consulta;
        }
        return (int) $consulta->rowCount();
    }
    
    /**
     * 
     * @param type $consulta
     * @return type
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
     * 
     * @param type $consulta
     * @return type
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