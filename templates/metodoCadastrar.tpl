	/**
	 * Cadastrar %%NOME_CLASSE%%
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar%%NOME_CLASSE%%($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formularioCadastro%%NOME_CLASSE%%($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormularioCadastro%%NOME_CLASSE%%($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		%%MONTA_OBJETO%%
		%%MONTA_OBJETOBD%%
		if(!$o%%NOME_CLASSE%%BD->cadastrar($o%%NOME_CLASSE%%)){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}