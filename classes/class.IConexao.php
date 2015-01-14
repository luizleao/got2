<?php
/**
 * Interface de implementação de classes de conexão para qualquer SGBD
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
interface IConexao{
    
    /**
     * Executa uma instrução SQL do SGBD
     * 
     * @param string $sql Instrução SQL
     */
    function execute($sql);
    
    /**
     * Retorna a lista de tabelas de database
     * 
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
     * @param string $tabela Tabela do BD selecionada
     */
    function carregarColecaoColunasTabela($tabela);
    
    /**
     * Retorna os dados da chaves estrangeiras da coluna
     * 
     * @param string $bd Bando de Dados Selecionado
     * @param string $tabela Tabela selecionada
     * @param string $coluna Coluna selecionada
     */
    function dadosForeignKeyColuna($bd, $tabela, $coluna);
}

