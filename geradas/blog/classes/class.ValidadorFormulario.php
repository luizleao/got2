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
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idPost == ''){
			$this->msg = "Post invalido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao invalido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome invalido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email invalido!";
			return false;
		}	
		if($webpage == ''){
			$this->msg = "Webpage invalido!";
			return false;
		}	
		if($dataHoraCadastro == ''){
			$this->msg = "DataHoraCadastro invalido!";
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
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idUsuario == ''){
			$this->msg = "Usuario invalido!";
			return false;
		}	
		if($titulo == ''){
			$this->msg = "Titulo invalido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao invalido!";
			return false;
		}	
		if($dataHoraCadastro == ''){
			$this->msg = "DataHoraCadastro invalido!";
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
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($login == ''){
			$this->msg = "Login invalido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha invalido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome invalido!";
			return false;
		}	
		if($ativo == ''){
			$this->msg = "Ativo invalido!";
			return false;
		}	
		if($grupo == ''){
			$this->msg = "Grupo invalido!";
			return false;
		}	
		*/
		return true;		
	}

}