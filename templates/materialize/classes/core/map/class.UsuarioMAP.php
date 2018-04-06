<?php
class UsuarioMAP {

	static function objToRs($oUsuario){
		$reg['idUsuario'] = $oUsuario->idUsuario;
		$reg['login'] = $oUsuario->login;
		$reg['senha'] = $oUsuario->senha;
		$reg['nome'] = $oUsuario->nome;
		$reg['ativo'] = $oUsuario->ativo;
		$reg['grupo'] = $oUsuario->grupo;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUsuario = new Usuario();
		$oUsuario->idUsuario = $reg['usuario_idUsuario'];
		$oUsuario->login = $reg['usuario_login'];
		$oUsuario->senha = $reg['usuario_senha'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->ativo = $reg['usuario_ativo'];
		$oUsuario->grupo = $reg['usuario_grupo'];
		return $oUsuario;		   
	}
}
