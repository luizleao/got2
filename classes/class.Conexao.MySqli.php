<?php
/**
 * Conexão MySQL
 * 
 * Classe de conexão nativa com o SGBD MySQLi
 * 
 * @author Luiz Leão <luizleao@gmail.com> 
 */
class ConexaoMySqli implements IConexao{
    /**
     * Dados da conexão
     * 
     * @var resource
     */
    public $conexao;
    /**
     * Dados da consulta
     * 
     * @var resource
     */
    public $consulta;  
    /**
     * Mensagem do sistema
     * 
     * @var string 
     */
    public $msg;
    /**
     * Banco de dados selecionado
     * 
     * @var string 
     */
    public $db;

    /**
     * Método construtor da classe
     * 
     * @param string $servidor Servidor a ser utilizado
     * @return void
     */
    function __construct($servidor = 'Local'){
        switch ($servidor){
            case 'Local':
                $this->set_conexao(HOST,USER,PASSWD,DB);
            break;

            case 'Vazia':
            break;

            default:
                die("Servidor $servidor inexistente");
            break;
         }
    }
    
    /**
     * Seleciona a conexão com o SGBD
     * 
     * @param string $host Endereço do servidor
     * @param string $user Usuário do banco
     * @param string $senha Senha do banco
     * @param string $bd Banco de dados selecionado
     * @return void
     */
    function set_conexao($host,$user,$senha,$bd=NULL){       
        $this->conexao = new mysqli($host, $user, $senha);
        if($bd != NULL){
        	$this->db = $this->conexao->select_db($bd);
        }
    }
    
    /**
     * Executa uma instrução SQL do SGBD
     * 
     * @param string $sql
     * @return boolean
     */
    function execute($sql){
    	$consulta = $this->conexao->query($sql);
        if($consulta){
            $this->consulta = $consulta;
        }
        else{
            //print $sql;
        	$this->msg = $this->conexao->error;
            return false;
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
        if(!$consulta) {
            $consulta = $this->consulta;
        }
        return (int) $this->conexao->affected_rows;
    }
    
    /**
     * Retorna os dados da consulta em forma de array
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchReg($consulta = NULL){
        if(!$consulta) {
            $consulta = $this->consulta;
        }
        //return @mysql_fetch_array($consulta);
        return $consulta->fetch_array();
    }
    
    /**
     * Retorna os dados da consulta em forma de HASH, 
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchRow($consulta = NULL){
        if(!$consulta) {
            $consulta = $this->consulta;
        }
        //return @mysql_fetch_row($consulta);
        return $consulta->fetch_row();
    }
    
    /**
     * Retorna o ultimo ID inserido por uma consulta recente
     * 
     * @return int
     */
    function lastID(){
/*
        $consulta = $this->execute("select LAST_INSERT_ID()");
        $res = @@mysql_fetch_array($consulta);

        return $res[0];
*/
        //print_r($this);
        //return @mysql_insert_id($this->conexao);
        return $this->conexao->insert_id;
    }
    
    /**
     * Encerra a conexão
     * 
     * @return void
     */
    function close(){
        //@mysql_close($this->conexao);
    	$this->conexao->close();
    }
    
    /**
     * Executa o inicio da transação
     * 
     * @return void
     */
    function beginTrans(){
        $this->execute("BEGIN");	
    }
    
    /**
     * Executa o fim da transação
     * 
     * @return void
     */
    function commitTrans(){
        $this->execute("COMMIT");		
    }
    
    /**
     * Executa o cancelamento da transação
     * 
     * @return void
     */
    function rollBackTrans(){
        $this->execute("ROLLBACK");
    }

    /**
     * Returna a lista de databases do servidor
     * 
     * @return string[]
     */
    function databases(){
        $this->execute("SHOW DATABASES");
        $aDatabases = array();
        while ($aReg = $this->fetchRow()){
            $aDatabases[] = $aReg[0];
        }
        sort($aDatabases, SORT_STRING);
        return $aDatabases;
    }
    
    /**
     * Lista as colunas da tabela
     * 
     * @param string $tabela
     * @return string[]
     */
    public function getAllColunasTabela($tabela) {
        $this->execute("SHOW COLUMNS FROM $tabela");
        $aDados = array();
        while ($aReg = $this->fetchReg()){
            $aDados[] = $aReg;
        }
        return $aDados;
    }
    
    /**
     * Retorna os dados das FK da tabela selecionada
     * 
     * @param string $db Banco de dados selecionado
     * @param string $tabela Nome da tabela
     * @param string $coluna Nome da coluna
     * @return string[]
     */
    public function dadosForeignKeyColuna($db, $tabela, $coluna) {
        $this->execute("
                        SELECT
                            REFERENCED_TABLE_NAME,
                            REFERENCED_COLUMN_NAME
                        FROM
                            information_schema.KEY_COLUMN_USAGE
                        where
                            TABLE_SCHEMA 	= '$db'
                            and TABLE_NAME 	= '$tabela'
                            and CONSTRAINT_NAME <> 'PRIMARY'
                            and COLUMN_NAME     = '$coluna';");

        return $this->fetchReg();
    }

    /**
     * Retorna a lista de tabelas do servidor
     * 
     * @return string[]
     */
    public function getAllTabelas() {
        $this->execute("SHOW TABLE STATUS");
        $aDados = array();
        while ($aReg = $this->fetchReg()){
            $aDados[] = $aReg;
        }
        return $aDados;
    }
}