	/**
	 * Carregar Colecao de dados de %%NOME_CLASS%%
	 *
	 * @access public
	 * @return %%NOME_CLASS%%[]
	 */
	public function carregarColecao%%NOME_CLASS%%(){		
		%%MONTA_OBJETOBD%%
		if($o%%NOME_CLASS%%BD->msg != ''){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;
		}
		return $o%%NOME_CLASS%%BD->carregarColecao();
	}