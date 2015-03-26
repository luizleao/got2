// ================ Seguranca ==========================

	/**
	 * Carrega colecao de modulos de um sistema
	 *
	 * @param integer $idSistema
	 * @return Modulo[]
	 */
	function getAllModuloPorSistema($idSistema){
		$oModuloBD = new ModuloBD();
		return $oModuloBD->getAllModuloPorSistema($idSistema);
	}

	/**
	 * Carrega colecao de modulos por grupo
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
	 * Carrega a Colecao dos Programas Por Grupo
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
	 * Carrega a colecao de programas por modulo 
	 *
	 * @param interger $idModulo
	 * @return Programa[]
	 */
	function getAllProgramaPorModulo($idModulo){
		$oProgramaBD = new ProgramaBD();
		return $oProgramaBD->getAllProgramaPorModulo($idModulo);
	}
			
	/**
	 * Carrega colecao de GRupos do usuario
	 *
	 * @param integer $idUsuario
	 * @return Usuariogrupo[]
	 */
	function getAllGruposUsuario($idUsuario){
		$oUsuariogrupoBD = new UsuariogrupoBD();
		return $oUsuariogrupoBD->getAllGruposUsuario($idUsuario);
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
			$aSistemaMenu = $this->getAllSistema();
			// ================ Varrendo Todos os sistemas cadastrados ===========
			foreach($aSistemaMenu as $oSistemaMenu){
				$aModuloMenu = $this->getAllModuloPorGrupo($oGrupoUsuario->get_idgrupo(), $oSistemaMenu->get_idsistema());
				if(count($aModuloMenu)>0){
					// ================ Varrendo Todos os modulos relacionados ao grupo ===========
					foreach($aModuloMenu as $oModuloMenu){
						$aProgramaMenu = $this->getAllProgramaPorGrupo($oGrupoUsuario->get_idgrupo(), $oModuloMenu->get_idmodulo());
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
	function getAllPesquisaPessoa($txtPesquisa){
		$oPessoaBD = new PessoaBD();
		return $oPessoaBD->getAllPesquisaPessoa($txtPesquisa);
	}
