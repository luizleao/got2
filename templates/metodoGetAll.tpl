	/**
	 * Carregar Colecao de dados de %%NOME_CLASS%%
	 *
	 * @access public
         * @param string[] $filtro Filtro de consulta
         * @param string[] $ordenacao Ordenação dos campos
	 * @return %%NOME_CLASS%%[]
	 */
	public function getAll%%NOME_CLASS%%($aFiltro = NULL, $aOrdenacao = NULL){
		%%MONTA_OBJETOBD%%
		if($o%%NOME_CLASS%%BD->msg != ''){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;
		}
		return $o%%NOME_CLASS%%BD->carregarColecao($aFiltro, $aOrdenacao);
	}