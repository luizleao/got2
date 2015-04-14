	function getAllGruposUsuario($idPessoa){
		$sql = "
				select
					T1.idPessoa as usuariogrupo_idPessoa,
					T1.idGrupo as usuariogrupo_idGrupo,
					T1.data as usuariogrupo_data,
					T2.idPessoa as usuario_idPessoa,
					T2.login as usuario_login,
					T2.senha as usuario_senha,
					T2.dataCadastro as usuario_dataCadastro,
					T3.idPessoa as pessoa_idPessoa,
					T3.nome as pessoa_nome,
					T3.email as pessoa_email,
					T3.endereco as pessoa_endereco,
					T3.numero as pessoa_numero,
					T3.complemento as pessoa_complemento,
					T3.telefone as pessoa_telefone,
					T3.celular as pessoa_celular,
					T3.bairro as pessoa_bairro,
					T3.municipio as pessoa_municipio,
					T3.estado as pessoa_estado,
					T3.cep as pessoa_cep,
					T4.idGrupo as grupo_idGrupo,
					T4.descricao as grupo_descricao,
					T4.master as grupo_master 
				from
					usuariogrupo T1
				join usuario T2
					on (T1.idPessoa = T2.idPessoa)
				join pessoa T3
					on (T3.idPessoa = T2.idPessoa)
				join grupo T4
					on (T4.idGrupo = T1.idGrupo)
				where
					T2.idPessoa = $idPessoa";
		//print "<pre>$sql</pre>";
		try{
			$this->oConexao->execute($sql);
			$aObj = array();
			if($this->oConexao->numRows() > 0){
				while ($aReg = $this->oConexao->fetchReg()){
					$aObj[] = UsuariogrupoMAP::rsToObj($aReg);
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
    
    function excluirGruposUsuario($idPessoa){
    	$sql = "
    			delete from 
    				usuario
    			where
    				idPessoa = $idPessoa";
		
    	try{
			$this->oConexao->execute($sql);
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
    }