<?php
class DadosFormulario {

	static function formularioCadastroComentario($acao=''){
		$post = array();

		if($acao == 2){
			$post["idComentario"] = strip_tags(addslashes(trim($_REQUEST["idComentario"])));
		}
		$post["idPost"] = strip_tags(addslashes(trim($_REQUEST["idPost"])));
		$post["descricao"] = strip_tags(addslashes(trim($_REQUEST["descricao"])));
		$post["nome"] = strip_tags(addslashes(trim($_REQUEST["nome"])));
		$post["email"] = strip_tags(addslashes(trim($_REQUEST["email"])));
		$post["webpage"] = strip_tags(addslashes(trim($_REQUEST["webpage"])));
		$post["dataHoraCadastro"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($_REQUEST["dataHoraCadastro"]))));
	
		return $post;		
	}

	static function formularioCadastroPost($acao=''){
		$post = array();

		if($acao == 2){
			$post["idPost"] = strip_tags(addslashes(trim($_REQUEST["idPost"])));
		}
		$post["idUsuario"] = strip_tags(addslashes(trim($_REQUEST["idUsuario"])));
		$post["titulo"] = strip_tags(addslashes(trim($_REQUEST["titulo"])));
		$post["descricao"] = strip_tags(addslashes(trim($_REQUEST["descricao"])));
		$post["dataHoraCadastro"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($_REQUEST["dataHoraCadastro"]))));
	
		return $post;		
	}

	static function formularioCadastroUsuario($acao=''){
		$post = array();

		if($acao == 2){
			$post["idUsuario"] = strip_tags(addslashes(trim($_REQUEST["idUsuario"])));
		}
		$post["login"] = strip_tags(addslashes(trim($_REQUEST["login"])));
		$post["senha"] = strip_tags(addslashes(trim($_REQUEST["senha"])));
		$post["nome"] = strip_tags(addslashes(trim($_REQUEST["nome"])));
		$post["ativo"] = strip_tags(addslashes(trim($_REQUEST["ativo"])));
		$post["grupo"] = strip_tags(addslashes(trim($_REQUEST["grupo"])));
	
		return $post;		
	}

}
