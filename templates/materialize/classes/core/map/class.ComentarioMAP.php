<?php
class ComentarioMAP {

	static function objToRs($oComentario){
		$reg['idComentario'] = $oComentario->idComentario;
		$oPost = $oComentario->oPost;
		$reg['idPost'] = $oPost->idPost;
		$reg['descricao'] = $oComentario->descricao;
		$reg['nome'] = $oComentario->nome;
		$reg['email'] = $oComentario->email;
		$reg['webpage'] = $oComentario->webpage;
		$reg['dataHoraCadastro'] = $oComentario->dataHoraCadastro;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oComentario = new Comentario();
		$oComentario->idComentario = $reg['comentario_idComentario'];

		$oPost = new Post();
		$oPost->idPost = $reg['post_idPost'];
		$oPost->titulo = $reg['post_titulo'];
		$oPost->descricao = $reg['post_descricao'];
		$oPost->dataHoraCadastro = $reg['post_dataHoraCadastro'];
		$oComentario->oPost = $oPost;
		$oComentario->descricao = $reg['comentario_descricao'];
		$oComentario->nome = $reg['comentario_nome'];
		$oComentario->email = $reg['comentario_email'];
		$oComentario->webpage = $reg['comentario_webpage'];
		$oComentario->dataHoraCadastro = $reg['comentario_dataHoraCadastro'];
		return $oComentario;		   
	}
}
