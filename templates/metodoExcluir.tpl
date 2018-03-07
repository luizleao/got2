	/**
	 * Excluir %%NOME_CLASS%%
	 *
	 * @access public
	 * @param integer $id%%NOME_CLASS%%
	 * @return bool
	 */
	public function excluir%%NOME_CLASS%%($id%%NOME_CLASS%%){		
		%%MONTA_OBJETOBD%%		
		if(!$o%%NOME_CLASS%%BD->excluir($id%%NOME_CLASS%%)){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;	
		}		
		return true;		
	}