<?php
/**
 * Interface de implementação de classes de conexão para qualquer SGBD
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
interface IConexao{
    
    /**
     * Retorna a lista de tabelas de database
     * 
     */
    function execute($sql);
    
    /**
     * Executa uma consulta do SGBD
     * 
     * @param string $sql
     */
    function carregarColecaoTabelas();
    
    /**
     * Returna a lista de databases do servidor
     * 
     * @return string[]
     */
    function databases();
    
    /**
     * Retorna a lista de colunas de uma tabela
     * 
     * @param string $tabela
     */
    function carregarColecaoColunasTabela($tabela);
    
    /**
     * Retorna os dados da chaves estrangeiras da coluna
     * 
     * @param string $db
     * @param string $tabela
     * @param string $coluna
     */
    function dadosForeignKeyColuna($db, $tabela, $coluna);
}

