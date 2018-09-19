	/**
	 * Carregar Colecao de dados de %%NOME_CLASSE%%
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return %%NOME_CLASSE%%[]
	 */
	public function getAll%%NOME_CLASSE%%($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			%%MONTA_OBJETOBD%%
			$aux = $o%%NOME_CLASSE%%BD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($o%%NOME_CLASSE%%BD->msg != ''){
				$this->msg = $o%%NOME_CLASSE%%BD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}