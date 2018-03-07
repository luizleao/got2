	/**
	 * Carregar Colecao de dados de %%NOME_CLASS%%
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $qtd Quantidade de registros por pagina
     * @param integer $pagina Numero da Pagina 
	 * @return %%NOME_CLASS%%[]
	 */
	public function getAll%%NOME_CLASS%%($aFiltro = NULL, $aOrdenacao = NULL, $qtd=NULL, $pagina=NULL){
		try{		
			%%MONTA_OBJETOBD%%
			$aux = $o%%NOME_CLASS%%BD->getAll($aFiltro, $aOrdenacao, $qtd, $pagina);
			
			if($o%%NOME_CLASS%%BD->msg != ''){
				$this->msg = $o%%NOME_CLASS%%BD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}