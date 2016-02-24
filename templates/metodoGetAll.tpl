	/**
	 * Carregar Colecao de dados de %%NOME_CLASS%%
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
	 * @return %%NOME_CLASS%%[]
	 */
	public function getAll%%NOME_CLASS%%($aFiltro = NULL, $aOrdenacao = NULL){
		%%MONTA_OBJETOBD%%
		if($o%%NOME_CLASS%%BD->msg != ''){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;
		}
		return $o%%NOME_CLASS%%BD->getAll($aFiltro, $aOrdenacao);
	}