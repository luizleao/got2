	/**
	 * Consultar registros de %%NOME_CLASSE%%
	 *
	 * @access public
	 * @param string $valor
	 * @return %%NOME_CLASSE%%
	 */
	public function consultar%%NOME_CLASSE%%($valor){
		%%MONTA_OBJETOBD%%	
		return $o%%NOME_CLASSE%%BD->consultar($valor);
	}