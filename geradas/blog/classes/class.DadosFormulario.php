<?php
class DadosFormulario {

	static function formularioCadastroComentario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idComentario"] = strip_tags(addslashes(trim($post["idComentario"])));
		}
		$post["idPost"] = strip_tags(addslashes(trim($post["idPost"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["email"] = strip_tags(addslashes(trim($post["email"])));
		$post["webpage"] = strip_tags(addslashes(trim($post["webpage"])));
		$post["dataHoraCadastro"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraCadastro"]))));
	
		return $post;		
	}

	static function formularioCadastroPost($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idPost"] = strip_tags(addslashes(trim($post["idPost"])));
		}
		$post["idUsuario"] = strip_tags(addslashes(trim($post["idUsuario"])));
		$post["titulo"] = strip_tags(addslashes(trim($post["titulo"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["dataHoraCadastro"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraCadastro"]))));
	
		return $post;		
	}

	static function formularioCadastroUsuario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idUsuario"] = strip_tags(addslashes(trim($post["idUsuario"])));
		}
		$post["login"] = strip_tags(addslashes(trim($post["login"])));
		$post["senha"] = strip_tags(addslashes(trim($post["senha"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["ativo"] = strip_tags(addslashes(trim($post["ativo"])));
		$post["grupo"] = strip_tags(addslashes(trim($post["grupo"])));
	
		return $post;		
	}

}
