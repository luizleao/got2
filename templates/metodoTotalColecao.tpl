	/**
	 * Total de registros de %%NOME_CLASSE%%
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao%%NOME_CLASSE%%(){
		$o%%NOME_CLASSE%%BD = new %%NOME_CLASSE%%BD();
		return $o%%NOME_CLASSE%%BD->totalColecao();
	}