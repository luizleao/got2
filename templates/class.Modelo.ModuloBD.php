	function carregarColecaoModuloPorSistema($idSistema){
		$sql = "
				select
					T1.idModulo as modulo_idModulo,
					T1.idSistema as modulo_idSistema,
					T1.descricao as modulo_descricao,
					T2.idSistema as sistema_idSistema,
					T2.descricao as sistema_descricao 
				from
					modulo T1 
				left join sistema T2 
					on (T1.idSistema = T2.idSistema) 
				where
					T2.idSistema = $idSistema";

		try{
			$this->oConexao->execute($sql);
			$aObj = array();
			if($this->oConexao->numRows()){
				while ($aReg = $this->oConexao->fetchReg()){
					$aObj[] = ModuloMAP::rsToObj($aReg);
				}				
				return $aObj;
			} else {
				return false;
			}
    	}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}	
    }
	
	function carregarColecaoModuloPorGrupo($idGrupo, $idSistema){
		$sql = "
				select distinct
					T1.idModulo as modulo_idModulo,
					T3.idSistema as sistema_idSistema,
					T3.descricao as sistema_descricao,
					T1.descricao as modulo_descricao
				from
					modulo T1
				join programa T2
					on (T1.idModulo = T2.idModulo)
				join sistema T3
					on (T1.idSistema = T3.idSistema)
				join grupoprograma T4
					on (T2.idPrograma = T4.idPrograma)
				where
					T4.idGrupo 		  = $idGrupo
					and T1.idSistema  = $idSistema
					and T2.menu is true";
		//print "<pre>$sql</pre>";
		
		try{
			$this->oConexao->execute($sql);
			$aObj = array();
			if($this->oConexao->numRows()){
				while ($aReg = $this->oConexao->fetchReg()){
					$aObj[] = ModuloMAP::rsToObj($aReg);
				}				
				return $aObj;
			} else {
				return false;
			}
    	}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}	
    }
    
    function excluirModuloSistema($idsistema){
    		$conexao =& $this->get_conexao();
		$sql = "
				delete from
					modulo 
				where
					idSistema = '$idsistema'";
		
		try{
			$this->oConexao->execute($sql);
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
    }