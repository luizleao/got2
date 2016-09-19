<?php
class %%NOME_CLASSE%%MAP {

	static function getMetaData() {
		return %%ARRAY_CAMPOS%%;
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

	static function objToRs(%%OBJETO_CLASSE%%){
%%OBJ_TO_REG%%
		return $reg;		   
	}

	static function objToRsInsert(%%OBJETO_CLASSE%%){
%%OBJ_TO_REG_INSERT%%
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		%%OBJETO_CLASSE%% = new %%NOME_CLASSE%%();
%%REG_TO_OBJ%%
		return %%OBJETO_CLASSE%%;		   
	}
}
