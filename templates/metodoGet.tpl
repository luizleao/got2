	/**
	 * Selecionar registro de %%NOME_CLASSE%%
	 *
	 * @access public
%%DOC_LISTA_PK%%
	 * @return %%NOME_CLASSE%%
	 */
	public function get%%NOME_CLASSE%%(%%LISTA_PK%%){
		%%MONTA_OBJETOBD%%
		if($o%%NOME_CLASSE%%BD->msg != ''){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;
		}		
		return $o%%NOME_CLASSE%%BD->get(%%LISTA_PK%%);
	}