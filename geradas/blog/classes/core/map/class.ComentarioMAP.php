<?php
class ComentarioMAP {

	static function getMetaData() {
		return ['comentario' => ['idComentario', 
'idPost', 
'descricao', 
'nome', 
'email', 
'webpage', 
'dataHoraCadastro'], 
'post' => ['idPost', 
'idUsuario', 
'titulo', 
'descricao', 
'dataHoraCadastro']];
	}
	
	static function dataToSelect() {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
			}
		}
	
		return implode(",\n", $aux);
	}
	
	static function filterLike($valor) {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo like '$valor'";
			}
		}
	
		return implode("\nor ", $aux);
	}

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

	static function objToRsInsert($oComentario){
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
