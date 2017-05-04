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
     * Recupera as configurações de conexão LDAP
     * 
     * @return string[]
     */
	function getConfigLDAP(){
		$aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);
		return $aConfig['LDAP'];
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
/*    
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
        //print_r($this->getAllGruposUsuario($resultado->get_idUsuario()));
        $_SESSION['aGrupoUsuario'] = $oSeguranca->getAllGruposUsuario($oUsuario->oPessoa->idPessoa);
        if(count($_SESSION['aGrupoUsuario']) > 0){
            $_SESSION['aMenu'] = $oSeguranca->menuUsuario($_SESSION['aGrupoUsuario']);
        } else {
            $this->msg = "Nenhum dado de permissão de acesso cadastrado";
            return false;
        }
        unset($oUsuario);
*/        
        return true;
    }
    
    /**
     * Autentica o Usuario via LDAP
     * @param string $login
     * @param string $senha
     * @return object
     */
    function autenticaUsuarioLDAP($login, $senha){
        $aConfig = $this->getConfigLDAP();
        
        try{
            // Conexão com servidor AD. 
            $ad = ldap_connect($aConfig['servidor']);

            // Versao do protocolo       
            ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Usara as referencias do servidor AD, neste caso nao
            ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

            // Bind to the directory server.
            $bd = @ldap_bind($ad, $aConfig['dominio']."\\".$login, $senha) or die("Não foi possível pesquisa no AD.");    
            if($bd){
                // DEFINE O DN DO SERVIDOR LDAP     
                $dn = "ou={$aConfig['dominio']}, dc={$aConfig['dominio']}, dc={$aConfig['dc']}";
                $filter="(|(member=$login)(sAMAccountName=$login))";
                //$filter = "(|(sn=$usuario*)(givenname=$usuario*)(uid=$usuario))";
                // EXECUTA O FILTRO NO SERVIDOR LDAP     
                $sr = ldap_search($ad, $dn, $filter);        
                // PEGA AS INFORMAÇÕES QUE O FILTRO RETORNOU     
                $info = ldap_get_entries($ad, $sr);	

                $_SESSION['usuarioAtual']['login'] 	= $info[0]['samaccountname'][0];
                $_SESSION['usuarioAtual']['email'] 	= $info[0]['mail'][0];
                $_SESSION['usuarioAtual']['nome'] 	= $info[0]['displayname'][0];
                $_SESSION['usuarioAtual']['permissoes'] = $info[0]['memberof'];

                // ======== Formatando data vinda via LDAP ===========
                $fileTime      = $info[0]['lastlogon'][0];
                $winSecs       = (int)($fileTime / 10000000); // divide by 10 000 000 to get seconds
                $unixTimestamp = ($winSecs - 11644473600); // 1.1.1600 -> 1.1.1970 difference in seconds

                $_SESSION['usuarioAtual']['ultimoLogon'] = date("d/m/Y h:i:s", $unixTimestamp);
            } else {
                $this->msg = "Nao Conectado no servidor";
                return false;
            }
            return true;
            
        } catch(Exception $e){
            $this->msg = $e->getMessage();
            return false;
        }
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
	
// =============== Componentes ==================
    /**
     * Componente que exibe calendário
     *
     * @param string $nomeCampo
     * @param date $valorInicial
     * @param string $adicional
     * @param bool $hora
     * @return void
     */
	function componenteCalendario($nomeCampo, $valorInicial=NULL, $complemento=NULL,$hora=false){
		include(dirname(dirname(__FILE__))."/componentes/componenteCalendario.php");
	}

    /**
     * Componente que exibe mensagem na tela
     * 
     * @param string $msg
     * @param string $tipo
     * @access public
     * @return void
     */
	public function componenteMsg($msg, $tipo="erro"){
		include(dirname(dirname(__FILE__))."/componentes/componenteMsg.php");
	}
    
    /**
     * Componente de lista de UFs
     * 
     * @param string $nomeCampo
     * @param string $valor
     * @access public
     * @return void
     */
	public function componenteListaUf($nomeCampo, $valor=NULL){
		include(dirname(dirname(__FILE__))."/componentes/componenteListaUf.php");
	}
}