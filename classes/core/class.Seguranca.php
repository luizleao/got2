<?php
require_once(dirname(__FILE__).'/bd/class.SistemaBD.php');
require_once(dirname(__FILE__).'/bd/class.ModuloBD.php');
require_once(dirname(__FILE__).'/bd/class.ProgramaBD.php');
require_once(dirname(__FILE__).'/bd/class.GrupoProgramaBD.php');
require_once(dirname(__FILE__).'/bd/class.GrupoBD.php');
require_once(dirname(__FILE__).'/bd/class.UsuarioGrupoBD.php');
require_once(dirname(__FILE__).'/bd/class.UsuarioBD.php');
require_once(dirname(__FILE__).'/bd/class.LogAcessoBD.php');

/**
 * Classe de Segurança
 * 
 * Implementa os métodos de manipulação do modelo de segurança
 * 
 * @category Seguranca
 * @author Luiz Leão <luizleao@gmail.com>
 */
class Seguranca{
    /**
     * Armazena as mensagens do programa
     *
     * @var string
     */
    public $msg;
    
    /**
     * Método construtor da classe
     * 
     * @return void
     */
    function __construct(){

    }

    /**
     * Menu montado de acordo com as permissoes dos grupos que o usuario faz parte
     * 
     * @param UsuarioGrupo $aGrupoUsuario Lista de grupos que o usuário tem permissão de acesso
     * @return string[]
     */
    function menuUsuario($aGrupoUsuario){
        // ========== Varrendo os Grupos do usuario ==========
        foreach($aGrupoUsuario as $oGrupoUsuario){
            $oSistemaBD = new SistemaBD();
            $aSistemaMenu = $oSistemaBD->getAll();
            // ================ Varrendo Todos os sistemas cadastrados ===========
            foreach($aSistemaMenu as $oSistemaMenu){
                $aModuloMenu = $this->getAllModuloPorGrupo($oGrupoUsuario->oGrupo->idGrupo, $oSistemaMenu->idSistema);
                if($aModuloMenu){
                    // ================ Varrendo Todos os modulos relacionados ao grupo ===========
                    foreach($aModuloMenu as $oModuloMenu){
                        $aProgramaMenu = $this->getAllProgramaPorGrupo($oGrupoUsuario->oGrupo->idGrupo, $oModuloMenu->idModulo);
                        // ================ Varrendo Todos os programas do referido modulo ===========
                        foreach($aProgramaMenu as $oProgramaMenu){
                            $aMenu[$oSistemaMenu->descricao][$oModuloMenu->descricao][$oProgramaMenu->descricao] = array("idPrograma" => $oProgramaMenu->idPrograma, 
                                                                                                                                                                                                                         "pagina"	  => $oProgramaMenu->pagina);
                        }
                    }
                }
            }
        }
        return $aMenu;
    }

    /**
     * Verifica a existencia de um usuario cadastrado 
     *
     * @param string $login Login a ser verificado
     * @return boolean
     */
    function verificaLoginUsuario($login){
        $oUsuarioDB = new UsuarioBD();	
        return ($oUsuarioDB->selecionarUsuarioPorLogin($login)) ? true : false;
    }

    /**
     * Carregar colecao de Modulos por sistema
     *
     * @param integer $idSistema Id do sistema
     * @return Modulo[]
     */
    function getAllModuloPorSistema($idSistema){
        $oModuloBD = new ModuloBD();
        return $oModuloBD->getAllModuloPorSistema($idSistema);
    }

    /**
     * Carregar colecao de Modulos por grupo
     *
     * @param integer $idGrupo
     * @param integer $idSistema
     * @return Modulo[]
     */
    function getAllModuloPorGrupo($idGrupo, $idSistema){
        $oModuloBD = new ModuloBD();
        return $oModuloBD->getAllModuloPorGrupo($idGrupo, $idSistema);
    }

    /**
     * Carregar colecao de programas por grupo
     *
     * @param integer $idGrupo
     * @param integer $idModulo
     * @return Programa[]
     */
    function getAllProgramaPorGrupo($idGrupo, $idModulo){
        $oProgramaBD = new ProgramaBD();
        return $oProgramaBD->getAllProgramaPorGrupo($idGrupo, $idModulo);
    }

    /**
     * Carregar colecao de programas por modulo
     *
     * @param integer $idModulo
     * @return Programa[]
     */
    function getAllProgramaPorModulo($idModulo){
            $oProgramaBD = new ProgramaBD();
            return $oProgramaBD->getAllProgramaPorModulo($idModulo);
    }

    /**
     * Alterar Senha do Usuario
     *
     * @return boolean
     */
    function alteraSenhaUsuario(){
        //print "@@"; exit;
        $post = DadosFormulario::formularioCadastroUsuario();
        $_SESSION["post"] = $post;
        //print_r($post); exit;
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroUsuario($post)){
                $this->msg = $oValidador->msg;
                return false;
        }
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para gravá-lo no BD
        $oPessoa = new Pessoa($idPessoa);
        $oUsuario = new Usuario($oPessoa,$login,$senha2,$dataCadastro);	
        $oUsuarioBD = new UsuarioBD();
        if(!$oUsuarioBD->alterarSenhaUsuario($idPessoa, $senha2)){
                $this->msg = $oUsuarioBD->msg;
                return false;	
        }
        $_SESSION['usuarioAtual']->senha = md5(strip_tags(trim($senha2)));
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Carregar colecao de grupos do usuario
     *
     * @param integer $idPessoa
     * @return Usuariogrupo[]
     */
    function getAllGruposUsuario($idPessoa){
        $oUsuariogrupoBD = new UsuariogrupoBD();
        $a = $oUsuariogrupoBD->getAllGruposUsuario($idPessoa);
        if(!$a){
            $this->msg = $oUsuariogrupoBD->msg;
            return false;
        }
        return $a;
    }

    /**
     * Exlcluir Todos Modulos do Grupo
     *
     * @param integer $idGrupo
     * @return boolean
     */
    function excluirTodoProgramaGrupo($idGrupo){
        $oGrupoProgramaBD = new GrupoProgramaBD();		
        return $oGrupoProgramaBD->excluirTodoProgramaGrupo($idGrupo);
    }
    /**
     * Transacao de cadastro de programas a um grupo
     * 
     * @param string[] $aRequest
     * @return boolean
     */
    function transacaoCadastraProgramaGrupo($aRequest){
        $oGrupoProgramaBD = new GrupoProgramaBD();
        $oConexao = $oGrupoProgramaBD->get_conexao();
        $oConexao->beginTrans();


        if(!$oGrupoProgramaBD->excluirTodoProgramaGrupo($aRequest['idGrupo'])){
                $this->msg = $oConexao->msg;
                $oConexao->rollBackTrans();
                return false;		
        }

        if(count($aRequest['idPrograma']) > 0){
            foreach($aRequest['idPrograma'] as $campo){
                $oGrupo 		= new Grupo($aRequest['idGrupo']);
                $oPrograma 		= new Programa($campo);
                $oGrupoPrograma = new GrupoPrograma($oGrupo, $oPrograma);

                if(!$oGrupoProgramaBD->inserir($oGrupoPrograma)){
                        $this->msg = $oConexao->msg;
                        $oConexao->rollBackTrans();
                        return false;
                }
            }
        }
        $oConexao->commitTrans();
        return true;
    }
}