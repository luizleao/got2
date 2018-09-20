	/**
	 * Alterar dados de %%NOME_CLASSE%%
	 *
	 * @access public
	 * @param %%NOME_CLASSE%% $o%%NOME_CLASSE%%
	 * @return bool
	 */
	public function alterar%%NOME_CLASSE%%($o%%NOME_CLASSE%% = NULL){
		if($o%%NOME_CLASSE%% == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formularioCadastro%%NOME_CLASSE%%(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormularioCadastro%%NOME_CLASSE%%($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			%%MONTA_OBJETO%%		
		}		
		%%MONTA_OBJETOBD%%
		if(!$o%%NOME_CLASSE%%BD->alterar($o%%NOME_CLASSE%%)){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;	
		}		
		return true;		
	}