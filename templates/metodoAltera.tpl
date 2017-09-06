	/**
	 * Alterar dados de %%NOME_CLASS%%
	 *
	 * @access public
	 * @param %%NOME_CLASS%% $o%%NOME_CLASS%%
	 * @return bool
	 */
	public function alterar%%NOME_CLASS%%($o%%NOME_CLASS%% = NULL){
		if($o%%NOME_CLASS%% == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formularioCadastro%%NOME_CLASS%%(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormularioCadastro%%NOME_CLASS%%($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = $v;
			// cria objeto para grava-lo no BD
			%%MONTA_OBJETO%%		
		}		
		%%MONTA_OBJETOBD%%
		if(!$o%%NOME_CLASS%%BD->alterar($o%%NOME_CLASS%%)){
			$this->msg = $o%%NOME_CLASS%%BD->msg;
			return false;	
		}		
		return true;		
	}