	function excluirTodoProgramaGrupo($idGrupo){
		$sql = "
				delete from
					grupoprograma 
				where
					idGrupo = $idGrupo";
		//print $sql;
		try{
			$this->oConexao->execute($sql);
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}			   
	}