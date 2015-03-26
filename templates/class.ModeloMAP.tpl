<?php
class %%NOME_CLASSE%%MAP {

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
