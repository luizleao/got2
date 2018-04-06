<?php
class Post {
	
	public $idPost;
	public $oUsuario;
	public $titulo;
	public $descricao;
	public $dataHoraCadastro;
	
	function __construct($idPost = NULL, Usuario $oUsuario = NULL, $titulo = NULL, $descricao = NULL, $dataHoraCadastro = NULL){
		$this->idPost = $idPost;
		$this->oUsuario = $oUsuario;
		$this->titulo = $titulo;
		$this->descricao = $descricao;
		$this->dataHoraCadastro = $dataHoraCadastro;
	}
}