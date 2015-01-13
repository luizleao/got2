	/**
	 * Consultar registros de %%NOME_CLASS%%
	 *
	 * @access public
	 * @param string $valor
	 * @return %%NOME_CLASS%%
	 */
	public function consultar%%NOME_CLASS%%($valor){
		%%MONTA_OBJETOBD%%	
		return $o%%NOME_CLASS%%BD->consultar($valor);
	}