<?php
/**
 * Class ControleWeb | classes/Class.ControleWeb.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
require_once(dirname(__FILE__)."/class.IConexao.php");
require_once(dirname(__FILE__)."/class.Conexao.MySql.php");
require_once(dirname(__FILE__)."/class.Conexao.MySqli.php");
require_once(dirname(__FILE__)."/class.Conexao.SqlServer.php");
require_once(dirname(__FILE__)."/class.Conexao.Postgre.php");
//require_once(dirname(__FILE__)."/class.Conexao.PDO.php");
require_once(dirname(__FILE__)."/class.DiretorioXML.php");
require_once(dirname(__FILE__)."/class.Geracao.php");
require_once(dirname(__FILE__)."/class.Util.php");
/**
 * Classe de Controle (Interface) do framework
 * 
 * Concentra as funcionalidades da ferramenta
 */
class ControleWeb{
    /**
     * Mensagem do sistema
     * 
     * @var string 
     */
    public $msg;
    
    /**
     * Método construtor
     * @return void
     */
    function __construct() {
        
    }
    
    /**
     * Conecta com o banco de dados selecionado
     * 
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean|\ConexaoSqlServer|\ConexaoMySql|\ConexaoPostgre
     */
    function conexao($sgbd, $host, $usuario, $senha, $bd=NULL){
        switch($sgbd){
            //case "mysql":     $oConexao = new ConexaoMySql('Vazia');     break;        
            case "mysql":     $oConexao = new ConexaoMySqli('Vazia');     break;
            case "sqlserver": $oConexao = new ConexaoSqlServer('Vazia'); break;
            case "postgre":   $oConexao = new ConexaoPostgre('Vazia');   break;
        }
        
        $oConexao->set_conexao($host, $usuario, $senha, $bd);
        
        if($oConexao->conexao){
            return $oConexao;
        }
        else{
            $this->msg = "Ocorreu o seguinte erro: ".$oConexao->msg;
            return false;
        }
    }
    
    /**
     * Gera o XML que contém as meta-informações do banco de dados
     * 
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean
     */
    function gerarXML($sgbd, $host, $usuario, $senha, $bd){
        //die("$sgbd, $host, $usuario, $senha, $bd");
        $oConexao = $this->conexao($sgbd, $host, $usuario, $senha, $bd);

        if($oConexao){
            $oXML = simplexml_load_string("<?xml version=\"1.0\" encoding=\"UTF-8\"?> <DATABASE NOME=\"$bd\" SGBD=\"$sgbd\" HOST=\"$host\" USER=\"$usuario\" SENHA=\"$senha\"></DATABASE>");            
            $aTabela = $oConexao->getAllTabelas();
            //print"<pre>"; print_r($aTabela); print"</pre>"; exit;
            
            foreach($aTabela as $sTabela){
                //print"<pre>"; print_r($sTabela); print"</pre>"; exit;
                $oTabela = $oXML->addChild("TABELA");
                $oTabela->addAttribute("NOME", $sTabela[0]);
                
                switch($sgbd){
                    case "mysql":     $oTabela->addAttribute("SCHEMA", ""); break;
                    case "sqlserver": $oTabela->addAttribute("SCHEMA", $sTabela[1]); break;
                }
                             
                $aColuna = $oConexao->getAllColunasTabela($sTabela[0]);
                //print "<pre>"; print_r($aColuna); print "</pre>"; exit;
                
                $qtd_pk_sem_incremento = 0;
                $qtd_pk_com_incremento = 0;

                foreach($aColuna as $sColuna){
                    if($sColuna[3] == 'PRI'){
                        if($sColuna[5] == 'auto_increment'){
                            $qtd_pk_com_incremento++;
                        } else {
                            $qtd_pk_sem_incremento++;
                        }
                    }
                                        
                    $oCampo = $oTabela->addChild("CAMPO");
/*                  $oCampo->addChild("NOME", $sColuna[0]);
                    $oCampo->addChild("TIPO", $sColuna[1]);
                    $oCampo->addChild("NULO", $sColuna[2]);
                    $oCampo->addChild("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0)); */
                    $oCampo->addAttribute("NOME", $sColuna[0]);
                    $oCampo->addAttribute("TIPO", $sColuna[1]);
                    $oCampo->addAttribute("NULO", $sColuna[2]);
                    $oCampo->addAttribute("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0));

                    $oFK = $oConexao->dadosForeignKeyColuna($bd, $sTabela[0], $sColuna[0]);
                    
                    if($oFK[0] != ''){
/*                         $oFkTabela = $oCampo->addChild("FKTABELA", $oFK[0]);
                        $oFkCampo  = $oCampo->addChild("FKCAMPO",  $oFK[1]); */
                    	$oFkTabela = $oCampo->addAttribute("FKTABELA", $oFK[0]);
                    	$oFkCampo  = $oCampo->addAttribute("FKCAMPO",  $oFK[1]);
                    } else {
/*                         $oFkTabela = $oCampo->addChild("FKTABELA", "");
                        $oFkCampo  = $oCampo->addChild("FKCAMPO",  ""); */
                    	$oFkTabela = $oCampo->addAttribute("FKTABELA", "");
                    	$oFkCampo  = $oCampo->addAttribute("FKCAMPO",  "");
                    }
                }

                //print "Tabela: {$reg[0]}\n qtd_pk_com_incremento: $qtd_pk_com_incremento \n qtd_pk_sem_incremento: $qtd_pk_sem_incremento\n\n";
                // ========== Verificar tipo da tabela ============
                if($qtd_pk_com_incremento == 1){
                    $oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
                } else {
                    if($qtd_pk_sem_incremento == 2){
                        $oTabela->addAttribute("TIPO_TABELA", 'N:M');
                    } elseif($qtd_pk_sem_incremento == 1) {
                        $oTabela->addAttribute("TIPO_TABELA", '1:1');
                    } else {
                        $oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
                    }
                }
            }
            
            $fp = fopen(dirname(dirname(__FILE__))."/xml/$bd.xml", "w+");
            fputs($fp, $oXML->asXML());
            fclose($fp);
            
            //print "<pre>".$oXML->asXML()."</pre>"; exit;
            $this->msg = ""; //Arquivo XML gerado com sucesso
            return true;
        }
        else{
            $this->msg = "Falha na geração do XML";
            return false;
        }
    }
    
    
    /**
     * Gera o Json que contém as meta-informações do banco de dados
     *
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean
     */
    function gerarJson($sgbd, $host, $usuario, $senha, $bd){
    	//die("$sgbd, $host, $usuario, $senha, $bd");
    	
    	/*
			

    	 */
    	
    	$oConexao = $this->conexao($sgbd, $host, $usuario, $senha, $bd);
    	
    	if($oConexao){
    		$oXML = simplexml_load_string("<?xml version=\"1.0\" encoding=\"UTF-8\"?> <DATABASE NOME=\"$bd\" SGBD=\"$sgbd\" HOST=\"$host\" USER=\"$usuario\" SENHA=\"$senha\"></DATABASE>");
    		$aTabela = $oConexao->getAllTabelas();
    		//print"<pre>"; print_r($aTabela); print"</pre>"; exit;
    		
    		foreach($aTabela as $sTabela){
    			//print"<pre>"; print_r($sTabela); print"</pre>"; exit;
    			$oTabela = $oXML->addChild("TABELA");
    			$oTabela->addAttribute("NOME", $sTabela[0]);
    			
    			switch($sgbd){
    				case "mysql":     $oTabela->addAttribute("SCHEMA", ""); break;
    				case "sqlserver": $oTabela->addAttribute("SCHEMA", $sTabela[1]); break;
    			}
    			
    			$aColuna = $oConexao->getAllColunasTabela($sTabela[0]);
    			//print "<pre>"; print_r($aColuna); print "</pre>"; exit;
    			
    			$qtd_pk_sem_incremento = 0;
    			$qtd_pk_com_incremento = 0;
    			
    			foreach($aColuna as $sColuna){
    				if($sColuna[3] == 'PRI'){
    					if($sColuna[5] == 'auto_increment'){
    						$qtd_pk_com_incremento++;
    					} else {
    						$qtd_pk_sem_incremento++;
    					}
    				}
    				
    				$oCampo = $oTabela->addChild("CAMPO");
    				/*                     $oCampo->addChild("NOME", $sColuna[0]);
    				 $oCampo->addChild("TIPO", $sColuna[1]);
    				 $oCampo->addChild("NULO", $sColuna[2]);
    				 $oCampo->addChild("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0)); */
    				$oCampo->addAttribute("NOME", $sColuna[0]);
    				$oCampo->addAttribute("TIPO", $sColuna[1]);
    				$oCampo->addAttribute("NULO", $sColuna[2]);
    				$oCampo->addAttribute("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0));
    				
    				$oFK = $oConexao->dadosForeignKeyColuna($bd, $sTabela[0], $sColuna[0]);
    				
    				if($oFK[0] != ''){
    					/*                         $oFkTabela = $oCampo->addChild("FKTABELA", $oFK[0]);
    					 $oFkCampo  = $oCampo->addChild("FKCAMPO",  $oFK[1]); */
    					$oFkTabela = $oCampo->addAttribute("FKTABELA", $oFK[0]);
    					$oFkCampo  = $oCampo->addAttribute("FKCAMPO",  $oFK[1]);
    				} else {
    					/*                         $oFkTabela = $oCampo->addChild("FKTABELA", "");
    					 $oFkCampo  = $oCampo->addChild("FKCAMPO",  ""); */
    					$oFkTabela = $oCampo->addAttribute("FKTABELA", "");
    					$oFkCampo  = $oCampo->addAttribute("FKCAMPO",  "");
    				}
    			}
    			
    			//print "Tabela: {$reg[0]}\n qtd_pk_com_incremento: $qtd_pk_com_incremento \n qtd_pk_sem_incremento: $qtd_pk_sem_incremento\n\n";
    			// ========== Verificar tipo da tabela ============
    			if($qtd_pk_com_incremento == 1){
    				$oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
    			} else {
    				if($qtd_pk_sem_incremento == 2){
    					$oTabela->addAttribute("TIPO_TABELA", 'N:M');
    				} elseif($qtd_pk_sem_incremento == 1) {
    					$oTabela->addAttribute("TIPO_TABELA", '1:1');
    				} else {
    					$oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
    				}
    			}
    		}
    		
    		$fp = fopen(dirname(dirname(__FILE__))."/xml/$bd.xml", "w+");
    		fputs($fp, $oXML->asXML());
    		fclose($fp);
    		
    		//print "<pre>".$oXML->asXML()."</pre>"; exit;
    		$this->msg = ""; //Arquivo XML gerado com sucesso
    		return true;
    	}
    	else{
    		$this->msg = "Falha na geração do XML";
    		return false;
    	}
    }
    
    /**
     * Gera os artefatos de software
     * 
     * @param string $xml Arquivo XML que contém o schema do banco de dados
     * @param string $gui Tipo de interface gráfica escolhida
     * @param boolean $moduloSeguranca Opção de gerar a aplicaççao com o módulo de segurança ou não
     * @return string
     */
    public function gerarArtefatos($xml, $gui, $moduloSeguranca){
    	try{
    		Util::excluirDiretorio("geradas/$xml");
	    	
	    	$oGeracao = new Geracao(dirname(dirname(__FILE__))."/xml/$xml.xml", $gui, $xml);
	        $msg = "Log de Geração de Artefatos - Projeto <strong>$xml</strong>: <br />";
	        $msg .= "Engine gráfica: <strong>$gui</strong>: <br /><hr /><pre>";
	        $msg .= str_pad("Geracao geraClassesBasicas ",50,".").           ((!$oGeracao->geraClassesBasicas())                       ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Pacote adicional ",50,".").                     ((!Util::copydir("templates/$gui/dir/", "geradas/$xml/")) ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClassesBDBase ",50,".").            ((!$oGeracao->geraClassesBDBase())                        ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClasseControle ",50,".").           ((!$oGeracao->geraClasseControle())                       ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClassesBD ",50,".").                ((!$oGeracao->geraClassesBD())                            ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClasseValidadorFormulario ",50,".").((!$oGeracao->geraClasseValidadorFormulario())            ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClasseDadosFormulario ",50,".").    ((!$oGeracao->geraClasseDadosFormulario())                ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraClassesMapeamento ",50,".").        ((!$oGeracao->geraClassesMapeamento())                    ? "Falha" : "Ok")."\n";
	        $msg .= str_pad("Geracao geraInterface ",50,".").                ((!$oGeracao->geraInterface())                            ? "Falha" : "Ok")."\n";
	        
	        if(!$moduloSeguranca){
	            $msg .= str_pad("Geracao Menu Estático ",51,".").            ((!$oGeracao->geraMenuEstatico())              ? "Falha" : "Ok")."</pre>";
	        }
	        return $msg;
    	} catch (Exception $e){
    		return "Erro na operação";
    	}
    }
    
    /**
     * Exclui o arquivo XML
     * 
     * @param string $xml Arquivo XML
     * @return boolean
     */
    public function excluirXML($xml){
    	try{
            unlink("xml/$xml.xml");
            $this->msg = "";
            return true;
    	} 
    	
    	catch(Exception $e){
            $this->msg = $e->getMessage();
            return false;
    	}
    } 
}
