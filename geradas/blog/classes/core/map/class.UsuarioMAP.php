<?php
class UsuarioMAP {

	static function getMetaData() {
		return ['usuario' => ['idUsuario', 
'login', 
'senha', 
'nome', 
'ativo', 
'grupo']];
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

	static function objToRs($oUsuario){
		$reg['idUsuario'] = $oUsuario->idUsuario;
		$reg['login'] = $oUsuario->login;
		$reg['senha'] = $oUsuario->senha;
		$reg['nome'] = $oUsuario->nome;
		$reg['ativo'] = $oUsuario->ativo;
		$reg['grupo'] = $oUsuario->grupo;
		return $reg;		   
	}

	static function objToRsInsert($oUsuario){
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
