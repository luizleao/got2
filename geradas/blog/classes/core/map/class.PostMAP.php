<?php
class PostMAP {

	static function objToRs($oPost){
		$reg['idPost'] = $oPost->idPost;
		$oUsuario = $oPost->oUsuario;
		$reg['idUsuario'] = $oUsuario->idUsuario;
		$reg['titulo'] = $oPost->titulo;
		$reg['descricao'] = $oPost->descricao;
		$reg['dataHoraCadastro'] = $oPost->dataHoraCadastro;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPost = new Post();
		$oPost->idPost = $reg['post_idPost'];

		$oUsuario = new Usuario();
		$oUsuario->idUsuario = $reg['usuario_idUsuario'];
		$oUsuario->login = $reg['usuario_login'];
		$oUsuario->senha = $reg['usuario_senha'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->ativo = $reg['usuario_ativo'];
		$oUsuario->grupo = $reg['usuario_grupo'];
		$oPost->oUsuario = $oUsuario;
		$oPost->titulo = $reg['post_titulo'];
		$oPost->descricao = $reg['post_descricao'];
		$oPost->dataHoraCadastro = $reg['post_dataHoraCadastro'];
		return $oPost;		   
	}
}
