<?php
require_once(dirname(__FILE__).'/bd/class.ComentarioBD.php');
require_once(dirname(__FILE__).'/bd/class.PostBD.php');
require_once(dirname(__FILE__).'/bd/class.UsuarioBD.php');
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
	
	/**
	 * Cadastrar Comentario
	 *
	 * @access public
	 * @return bool
	 */
	public function cadastraComentario(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroComentario();
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroComentario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oPost = new Post($idPost);
		$oComentario = new Comentario($idComentario,$oPost,$descricao,$nome,$email,$webpage,$dataHoraCadastro);
		$oComentarioBD = new ComentarioBD();
		if(!$oComentarioBD->inserir($oComentario)){
			$this->msg = $oComentarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Cadastrar Post
	 *
	 * @access public
	 * @return bool
	 */
	public function cadastraPost(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroPost();
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroPost($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($idUsuario);
		$oPost = new Post($idPost,$oUsuario,$titulo,$descricao,$dataHoraCadastro);
		$oPostBD = new PostBD();
		if(!$oPostBD->inserir($oPost)){
			$this->msg = $oPostBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Cadastrar Usuario
	 *
	 * @access public
	 * @return bool
	 */
	public function cadastraUsuario(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroUsuario();
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroUsuario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($idUsuario,$login,$senha,$nome,$ativo,$grupo);
		$oUsuarioBD = new UsuarioBD();
		if(!$oUsuarioBD->inserir($oUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

// ============ Funcoes de Alteracao =================

	/**
	 * Alterar dados de Comentario
	 *
	 * @access public
	 * @return bool
	 */
	public function alteraComentario(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroComentario(2);		
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroComentario($post,2)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oPost = new Post($idPost);
		$oComentario = new Comentario($idComentario,$oPost,$descricao,$nome,$email,$webpage,$dataHoraCadastro);		
		$oComentarioBD = new ComentarioBD();		
		if(!$oComentarioBD->alterar($oComentario)){
			$this->msg = $oComentarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Alterar dados de Post
	 *
	 * @access public
	 * @return bool
	 */
	public function alteraPost(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroPost(2);		
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroPost($post,2)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($idUsuario);
		$oPost = new Post($idPost,$oUsuario,$titulo,$descricao,$dataHoraCadastro);		
		$oPostBD = new PostBD();		
		if(!$oPostBD->alterar($oPost)){
			$this->msg = $oPostBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Alterar dados de Usuario
	 *
	 * @access public
	 * @return bool
	 */
	public function alteraUsuario(){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastroUsuario(2);		
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastroUsuario($post,2)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = $v;
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($idUsuario,$login,$senha,$nome,$ativo,$grupo);		
		$oUsuarioBD = new UsuarioBD();		
		if(!$oUsuarioBD->alterar($oUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

// ============ Funcoes de Exclusao =================

	/**
	 * Excluir Comentario
	 *
	 * @access public
	 * @param integer $idComentario
	 * @return bool
	 */
	public function excluiComentario($idComentario){		
		$oComentarioBD = new ComentarioBD();		
		if(!$oComentarioBD->excluir($idComentario)){
			$this->msg = $oComentarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Post
	 *
	 * @access public
	 * @param integer $idPost
	 * @return bool
	 */
	public function excluiPost($idPost){		
		$oPostBD = new PostBD();		
		if(!$oPostBD->excluir($idPost)){
			$this->msg = $oPostBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Usuario
	 *
	 * @access public
	 * @param integer $idUsuario
	 * @return bool
	 */
	public function excluiUsuario($idUsuario){		
		$oUsuarioBD = new UsuarioBD();		
		if(!$oUsuarioBD->excluir($idUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

// ============ Funcoes de Selecao =================

	/**
	 * Selecionar registro de Comentario
	 *
	 * @access public
	 * @param integer $idComentario
	 * @return Comentario
	 */
	public function selecionarComentario($idComentario){
		$oComentarioBD = new ComentarioBD();
		if($oComentarioBD->msg != ''){
			$this->msg = $oComentarioBD->msg;
			return false;
		}		
		return $oComentarioBD->selecionar($idComentario);
	}

	/**
	 * Selecionar registro de Post
	 *
	 * @access public
	 * @param integer $idPost
	 * @return Post
	 */
	public function selecionarPost($idPost){
		$oPostBD = new PostBD();
		if($oPostBD->msg != ''){
			$this->msg = $oPostBD->msg;
			return false;
		}		
		return $oPostBD->selecionar($idPost);
	}

	/**
	 * Selecionar registro de Usuario
	 *
	 * @access public
	 * @param integer $idUsuario
	 * @return Usuario
	 */
	public function selecionarUsuario($idUsuario){
		$oUsuarioBD = new UsuarioBD();
		if($oUsuarioBD->msg != ''){
			$this->msg = $oUsuarioBD->msg;
			return false;
		}		
		return $oUsuarioBD->selecionar($idUsuario);
	}

// ============ Funcoes de Colecao =================

	/**
	 * Carregar Colecao de dados de Comentario
	 *
	 * @access public
	 * @return Comentario[]
	 */
	public function carregarColecaoComentario(){		
		$oComentarioBD = new ComentarioBD();
		if($oComentarioBD->msg != ''){
			$this->msg = $oComentarioBD->msg;
			return false;
		}
		return $oComentarioBD->carregarColecao();
	}

	/**
	 * Carregar Colecao de dados de Post
	 *
	 * @access public
	 * @return Post[]
	 */
	public function carregarColecaoPost(){		
		$oPostBD = new PostBD();
		if($oPostBD->msg != ''){
			$this->msg = $oPostBD->msg;
			return false;
		}
		return $oPostBD->carregarColecao();
	}

	/**
	 * Carregar Colecao de dados de Usuario
	 *
	 * @access public
	 * @return Usuario[]
	 */
	public function carregarColecaoUsuario(){		
		$oUsuarioBD = new UsuarioBD();
		if($oUsuarioBD->msg != ''){
			$this->msg = $oUsuarioBD->msg;
			return false;
		}
		return $oUsuarioBD->carregarColecao();
	}

// ============ Funcoes de Consulta =================

	/**
	 * Consultar registros de Comentario
	 *
	 * @access public
	 * @param string $valor
	 * @return Comentario
	 */
	public function consultarComentario($valor){
		$oComentarioBD = new ComentarioBD();	
		return $oComentarioBD->consultar($valor);
	}

	/**
	 * Consultar registros de Post
	 *
	 * @access public
	 * @param string $valor
	 * @return Post
	 */
	public function consultarPost($valor){
		$oPostBD = new PostBD();	
		return $oPostBD->consultar($valor);
	}

	/**
	 * Consultar registros de Usuario
	 *
	 * @access public
	 * @param string $valor
	 * @return Usuario
	 */
	public function consultarUsuario($valor){
		$oUsuarioBD = new UsuarioBD();	
		return $oUsuarioBD->consultar($valor);
	}
	
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