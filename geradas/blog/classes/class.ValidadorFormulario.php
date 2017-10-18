<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormularioCadastroComentario(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idComentario == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idPost == ''){
			$this->msg = "Post inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email inválido!";
			return false;
		}	
		if($webpage == ''){
			$this->msg = "Webpage inválido!";
			return false;
		}	
		if($dataHoraCadastro == ''){
			$this->msg = "DataHoraCadastro inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroPost(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idPost == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idUsuario == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($titulo == ''){
			$this->msg = "Titulo inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($dataHoraCadastro == ''){
			$this->msg = "DataHoraCadastro inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroUsuario(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idUsuario == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($login == ''){
			$this->msg = "Login inválido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($ativo == ''){
			$this->msg = "Ativo inválido!";
			return false;
		}	
		if($grupo == ''){
			$this->msg = "Grupo inválido!";
			return false;
		}	
		*/
		return true;		
	}

}