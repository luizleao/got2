// ================ Seguranca ==========================

	/**
	 * Carrega colecao de modulos de um sistema
	 *
	 * @param integer $idSistema
	 * @return Modulo[]
	 */
	function carregarColecaoModuloPorSistema($idSistema){
		$oModuloBD = new ModuloBD();
		return $oModuloBD->carregarColecaoModuloPorSistema($idSistema);
	}

	/**
	 * Carrega colecao de modulos por grupo
	 *
	 * @param integer $idGrupo
	 * @param integer $idSistema
	 * @return Modulo[]
	 */
	function carregarColecaoModuloPorGrupo($idGrupo, $idSistema){
		$oModuloBD = new ModuloBD();
		return $oModuloBD->carregarColecaoModuloPorGrupo($idGrupo, $idSistema);
	}
	
	/**
	 * Carrega a Colecao dos Programas Por Grupo
	 *
	 * @param integer $idGrupo
	 * @param integer $idModulo
	 * @return Programa[]
	 */
	function carregarColecaoProgramaPorGrupo($idGrupo, $idModulo){
		$oProgramaBD = new ProgramaBD();
		return $oProgramaBD->carregarColecaoProgramaPorGrupo($idGrupo, $idModulo);
	}
	
	/**
	 * Carrega a colecao de programas por modulo 
	 *
	 * @param interger $idModulo
	 * @return Programa[]
	 */
	function carregarColecaoProgramaPorModulo($idModulo){
		$oProgramaBD = new ProgramaBD();
		return $oProgramaBD->carregarColecaoProgramaPorModulo($idModulo);
	}
			
	/**
	 * Carrega colecao de GRupos do usuario
	 *
	 * @param integer $idUsuario
	 * @return Usuariogrupo[]
	 */
	function carregarColecaoGruposUsuario($idUsuario){
		$oUsuariogrupoBD = new UsuariogrupoBD();
		return $oUsuariogrupoBD->carregarColecaoGruposUsuario($idUsuario);
	}
	
	/**
	 * Excluir Todos Modulos do Grupo
	 *
	 * @param integer $idGrupo
	 * @return bool
	 */
	function excluirTodoProgramaGrupo($idGrupo){
		$oGrupoprogramaBD = new GrupoprogramaBD();		
		return $oGrupoprogramaBD->excluirTodoProgramaGrupo($idGrupo);
	}
	
	/**
	 * Exclui todos os grupos relacionados ao usuário
	 *
	 * @param integer $idUsuario
	 * @return bool
	 */
	function excluirGruposUsuario($idUsuario){
		$oUsuarioGrupoBD = new UsuariogrupoBD();		
		return $oUsuarioGrupoBD->excluirGruposUsuario($idUsuario);
	}
	
	/**
	 * Menu montado de acordo com as permissoes dos grupos que o usuario faz parte
	 *
	 * @param string[] $aGrupoUsuario
	 * @return string[]
	 */
	function menuUsuario($aGrupoUsuario){
		// ========== Varrendo os Grupos do usuario ==========
		foreach($aGrupoUsuario as $oGrupoUsuario){
			$aSistemaMenu = $this->carregarColecaoSistema();
			// ================ Varrendo Todos os sistemas cadastrados ===========
			foreach($aSistemaMenu as $oSistemaMenu){
				$aModuloMenu = $this->carregarColecaoModuloPorGrupo($oGrupoUsuario->get_idgrupo(), $oSistemaMenu->get_idsistema());
				if(count($aModuloMenu)>0){
					// ================ Varrendo Todos os modulos relacionados ao grupo ===========
					foreach($aModuloMenu as $oModuloMenu){
						$aProgramaMenu = $this->carregarColecaoProgramaPorGrupo($oGrupoUsuario->get_idgrupo(), $oModuloMenu->get_idmodulo());
						// ================ Varrendo Todos os programas do referido modulo ===========
						foreach($aProgramaMenu as $oProgramaMenu){
							$aMenu[$oSistemaMenu->get_descricaoSistema()][$oModuloMenu->get_descricaomodulo()][$oProgramaMenu->get_descricaoprograma()] = array("idPrograma"=>$oProgramaMenu->get_idprograma(), "paginaPrograma"=>$oProgramaMenu->get_paginaprograma());
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
	 * @param string $login
	 * @return bool
	 */
	function verificaLoginUsuario($login){
		$oUsuarioDB = new UsuarioBD();	
		return ($oUsuarioDB->selecionarUsuarioPorLogin(strtoupper($login))) ? true : false;
	}
	
	/* ========= Pessoa ========= */
	/**
	 * Carregar lista de Pessoas atraves de uma entrada de dados
	 *
	 * @param string $txtPesquisa
	 * @return Pessoa[]
	 */	
	function carregarColecaoPesquisaPessoa($txtPesquisa){
		$oPessoaBD = new PessoaBD();
		return $oPessoaBD->carregarColecaoPesquisaPessoa($txtPesquisa);
	}
