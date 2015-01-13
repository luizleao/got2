<?php
%%LISTA_REQUIRE%%
//require_once(dirname(__FILE__).'/class.Seguranca.php');
require_once(dirname(__FILE__).'/core/class.Conexao.php');
require_once(dirname(__FILE__).'/core/class.Util.php');
require_once(dirname(__FILE__).'/class.ValidadorFormulario.php');
require_once(dirname(__FILE__).'/class.DadosFormulario.php');

class Controle{
	
    public $msg;

    function __construct(){
        session_start();
        /*header("content-type: text/html; charset=UTF-8", true);
            if(!preg_match("#index#is", $_SERVER['REQUEST_URI'])){
                if(!isset($_SESSION['usuarioAtual'])){
                        echo "
                        <script>
                                alert('Sessão expirou');
                                window.location='index.php';
                        </script>";
                        exit;
                }
            }
        */		
    }

    /**
     * Fecha a conexao com o BD
     * 
     * @return void
     */
    function fecharConexao(){
        $conexao = new Conexao();
        $conexao->close();
    }
    
    /**
     * Recupera as configurações de produção
     * 
     * @return string[]
     */
    function getConfigProducao(){
        $aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);
        return $aConfig['producao'];
    }
    
    /**
     * Cria instancia para a classe seguranca
     * 
     * @return Seguranca
     */
    function get_seguranca(){
        return new Seguranca();
    }
	
    /**
     * Autentica o Usuario
     * @param string $login
     * @param string $senha
     * @return object
     */
    function autenticaUsuario($login, $senha){
        $oUsuarioBD = new UsuarioBD();
        $oSeguranca = $this->get_seguranca();
        $oUsuario = $oUsuarioBD->autenticaUsuario($login, $senha);
        if(!$oUsuario){
            $this->msg = $oUsuarioBD->msg;
            return false;
        }

        $_SESSION['usuarioAtual'] = $oUsuario;
        //print "<pre>"; print_r($oUsuario); print "</pre>";
        // ========== Carregando Coleção dos Grupos do Usuário ==========
        //print_r($this->carregarColecaoGruposUsuario($resultado->get_idUsuario()));
        $_SESSION['aGrupoUsuario'] = $oSeguranca->carregarColecaoGruposUsuario($oUsuario->oPessoa->idPessoa);
        if(count($_SESSION['aGrupoUsuario']) > 0){
            $_SESSION['aMenu'] = $oSeguranca->menuUsuario($_SESSION['aGrupoUsuario']);
        } else {
            $this->msg = "Nenhum dado de permissão de acesso cadastrado";
            return false;
        }
        unset($oUsuario);
        return true;
    }
// ============ Funcoes de Cadastro ==================
	
%%METODOS_CADASTRA%%

// ============ Funcoes de Alteracao =================

%%METODOS_ALTERA%%

// ============ Funcoes de Exclusao =================

%%METODOS_EXCLUI%%

// ============ Funcoes de Selecao =================

%%METODOS_SELECIONAR%%

// ============ Funcoes de Colecao =================

%%METODOS_CARREGAR_COLECAO%%

// ============ Funcoes de Consulta =================

%%METODOS_CONSULTA%%
	
// ============ Funcoes Adicionais =================
// =============== Componentes ==================
    /**
     * Componente que exibe calendário
     *
     * @param String $nomeCampo
     * @param Date $valorInicial
     * @param String $adicional
     * @param Bool $hora
     * @return void
     */
    function componenteCalendario($nomeCampo, $valorInicial=NULL, $complemento=NULL,$hora=false){
        include(dirname(dirname(__FILE__))."/componentes/componenteCalendario.php");
    }

    /**
     * Componente que exibe mensagem na tela
     * 
     * @param String $msg
     * @param String $tipo
     * @access public
     * @return void
     */
    public function componenteMsg($msg, $tipo="erro"){
        include(dirname(dirname(__FILE__))."/componentes/componenteMsg.php");
    }
}