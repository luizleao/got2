<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Usuario.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.UsuarioMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.UsuarioBDBase.php');

class UsuarioBD extends UsuarioBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }
	
    function autenticaUsuario($login, $senha){
		$sql = "
				select 
					T1.idPessoa as usuario_idPessoa,
					T1.login as usuario_login,
					T1.senha as usuario_senha,
					T1.dataCadastro as usuario_dataCadastro,
					T2.idPessoa as pessoa_idPessoa,
					T2.nome as pessoa_nome,
					T2.email as pessoa_email,
					T2.endereco as pessoa_endereco,
					T2.numero as pessoa_numero,
					T2.complemento as pessoa_complemento,
					T2.telefone as pessoa_telefone,
					T2.celular as pessoa_celular,
					T2.cep as pessoa_cep,
					T2.bairro as pessoa_bairro  
				from 
					usuario T1
				join pessoa T2
					on (T1.idPessoa = T2.idPessoa)
				where 
					T1.login = '$login'";
		//print "<pre>$sql</pre>"; //exit;

		try{
			$this->oConexao->execute($sql);
			if($this->oConexao->numRows() > 0){ 
				$oReg = $this->oConexao->fetchReg();
				if($oReg['usuario_senha'] == $senha)
					return UsuarioMAP::rsToObj($oReg);
				else
					$this->msg = "Senha incorreta";
			} else {
				$this->msg = "Login inválido";
				return false;
			}
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	function selecionarUsuarioPorLogin($login){
		$sql = "
				select
					T1.idPessoa as usuario_idPessoa,
					T1.login as usuario_login,
					T1.senha as usuario_senha,
					T1.dataCadastro as usuario_dataCadastro,
					T2.idPessoa as pessoa_idPessoa,
					T2.nome as pessoa_nome,
					T2.email as pessoa_email,
					T2.endereco as pessoa_endereco,
					T2.numero as pessoa_numero,
					T2.complemento as pessoa_complemento,
					T2.telefone as pessoa_telefone,
					T2.celular as pessoa_celular,
					T2.cep as pessoa_cep,
					T2.bairro as pessoa_bairro 
				from
					usuario T1
				join pessoa T2
					on (T1.idPessoa = T2.idPessoa)
				where
					T1.login = '$login'";
		
		//print "<pre>$sql</pre>";

		try{
			$this->oConexao->execute($sql);
			if($this->oConexao->numRows() > 0){ 
				$aReg = $this->oConexao->fetchReg();
				return UsuarioMAP::rsToObj($aReg);
			} else {
				$this->msg = "Nenhum registro encontrado!";
				return false;
			}
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	function alterarSenhaUsuario($idPessoa, $senha){
		$sql = "	
				update 
					usuario 
				set
					senha = '$senha'
				where
					idPessoa = $idPessoa";
		//print($sql);
		try{
			$this->oConexao->execute($sql);
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
}