<?php
class Usuario {
	
	public $idUsuario;
	public $login;
	public $senha;
	public $nome;
	public $ativo;
	public $grupo;
	
	function __construct($idUsuario = NULL, $login = NULL, $senha = NULL, $nome = NULL, $ativo = NULL, $grupo = NULL){
		$this->idUsuario = $idUsuario;
		$this->login = $login;
		$this->senha = $senha;
		$this->nome = $nome;
		$this->ativo = $ativo;
		$this->grupo = $grupo;
	}
}