	/**
	 * Total de registros de %%NOME_CLASS%%
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao%%NOME_CLASS%%(){
		$o%%NOME_CLASS%%BD = new %%NOME_CLASS%%BD();
		return $o%%NOME_CLASS%%BD->totalColecao();
	}