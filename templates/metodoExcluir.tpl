	/**
	 * Excluir %%NOME_CLASSE%%
	 *
	 * @access public
	 * @param integer $id%%NOME_CLASSE%%
	 * @return bool
	 */
	public function excluir%%NOME_CLASSE%%($id%%NOME_CLASSE%%){		
		%%MONTA_OBJETOBD%%		
		if(!$o%%NOME_CLASSE%%BD->excluir($id%%NOME_CLASSE%%)){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;	
		}		
		return true;		
	}