	function carregarColecaoProgramaPorModulo($idModulo){
		$sql = "
				select
					T1.idPrograma as programa_idPrograma,
					T1.idModulo as programa_idModulo,
					T1.descricao as programa_descricao,
					T1.pagina as programa_pagina,
					T1.menu as programa_menu,
					T2.idModulo as modulo_idModulo,
					T2.idSistema as modulo_idSistema,
					T2.descricao as modulo_descricao 
				from
					programa T1
				left join modulo T2
					on (T1.idModulo = T2.idModulo)
				where
					T1.idModulo = $idModulo";

		try{
			$this->oConexao->execute($sql);
			$aObj = array();
			while ($aReg = $this->oConexao->fetchReg()){
				$aObj[] = ProgramaMAP::rsToObj($aReg);
			}				
			return $aObj;
    	}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}	
    }
	
	function carregarColecaoProgramaPorGrupo($idGrupo, $idModulo){
		$sql = "
				select distinct
					T1.idPrograma as programa_idPrograma,
					T1.idModulo as programa_idModulo,
					T1.descricao as programa_descricao,
					T1.pagina as programa_pagina,
					T1.menu as programa_menu 
				from
					programa T1
				join grupoPrograma T2
					on (T1.idPrograma = T2.idPrograma)
				where
					T2.idGrupo  	 = $idGrupo
					and T1.idModulo = $idModulo
					and T1.menu is true";
		
		//print "<pre>$sql</pre>";
		
		try{
			$this->oConexao->execute($sql);
			$aObj = array();
			while ($aReg = $this->oConexao->fetchReg()){
				$aObj[] = ProgramaMAP::rsToObj($aReg);
			}				
			return $aObj;
    	}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}	
    }