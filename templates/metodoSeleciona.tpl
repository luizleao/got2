	/**
	 * Selecionar registro de %%NOME_CLASS%%
	 *
	 * @access public
%%DOC_LISTA_PK%%
	 * @return %%NOME_CLASS%%
	 */
	public function selecionar%%NOME_CLASS%%(%%LISTA_PK%%){
		%%MONTA_OBJETOBD%%
		if($o%%NOME_CLASS%%BD->msg != ''){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;
		}		
		return $o%%NOME_CLASS%%BD->selecionar(%%LISTA_PK%%);
	}