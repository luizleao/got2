	function validaFormularioCadastro%%NOME_CLASSE%%(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		%%ATRIBUICAO%%
		*/
		return true;		
	}