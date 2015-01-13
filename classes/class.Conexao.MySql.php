<?php
/**
 * Classe de conexão nativa com o SGBD MySQL
 * 
 * @author Luiz Leão <luizleao@gmail.com> 
 * @filesource
 */
class ConexaoMySql implements IConexao{
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
     * ID da ultima inserção
     * 
     * @var int
     */
    public $last_id;

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
        $this->conexao = @mysql_connect($host,$user,$senha);// or die(@mysql_error());
        if($bd != NULL){
            $this->set_db($bd);
        }
    }
    
    /**
     * Executa uma consulta do SGBD
     * 
     * @param string $sql
     * @return boolean
     */
    function execute($sql){
        $consulta = @mysql_query($sql,$this->get_conexao());
        if($consulta){
            $this->set_consulta($consulta);
        }
        else{
            //print $sql;
            $this->msg = @mysql_error();
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
            $consulta = $this->get_consulta();
        }
        return (int) @mysql_num_rows($consulta);
    }
    
    /**
     * Retorna os dados da consulta em forma de array
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchReg($consulta = NULL){
        if(!$consulta) {
            $consulta = $this->get_consulta();
        }
        return @mysql_fetch_array($consulta);
    }
    
    /**
     * Retorna os dados da consulta em forma de HASH, 
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchRow($consulta = NULL){
        if(!$consulta) {
            $consulta = $this->get_consulta();
        }
        return @mysql_fetch_row($consulta);
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
        return @mysql_insert_id($this->get_conexao());
    }
    
    /**
     * Encerra a conexão
     * 
     * @return void
     */
    function close(){
        @mysql_close($this->get_conexao());
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
        return $aDatabases;
    }

    /**
     * Get Conexão
     * 
     * @return resource
     */
    function get_conexao(){
        return $this->conexao;
    }
    
    /**
     * Get mensagem
     * 
     * @return string
     */
    function get_msg(){
        return $this->msg;
    }

    /**
     * Set mensagem
     * 
     * @param string $msg
     */
    function set_msg($msg){
        $this->msg = $msg;
    }

    /**
     * Get Consulta
     * 
     * @return resource
     */
    function get_consulta(){
        return $this->consulta;
    }

    /**
     * Set Consulta
     * 
     * @param resource $consulta
     */
    function set_consulta($consulta){
        $this->consulta = $consulta;
    }

    /**
     * Set Banco de Dados
     * 
     * @param resource $db
     */
    function set_db($db){
        $this->db = @mysql_select_db($db);	
    }
    
    /**
     * Get Banco de Dados
     * 
     * @return resource
     */
    function get_db(){
        return $this->db;
    }
    
    /**
     * Lista as colunas da tabela
     * 
     * @param string $tabela
     * @return string[]
     */
    public function carregarColecaoColunasTabela($tabela) {
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
    public function carregarColecaoTabelas() {
        $this->execute("SHOW TABLE STATUS");
        $aDados = array();
        while ($aReg = $this->fetchReg()){
            $aDados[] = $aReg;
        }
        return $aDados;
    }
}