<?php
class Comentario {
	
	public $idComentario;
	public $oPost;
	public $descricao;
	public $nome;
	public $email;
	public $webpage;
	public $dataHoraCadastro;
	
	function __construct($idComentario = NULL, Post $oPost = NULL, $descricao = NULL, $nome = NULL, $email = NULL, $webpage = NULL, $dataHoraCadastro = NULL){
		$this->idComentario = $idComentario;
		$this->oPost = $oPost;
		$this->descricao = $descricao;
		$this->nome = $nome;
		$this->email = $email;
		$this->webpage = $webpage;
		$this->dataHoraCadastro = $dataHoraCadastro;
	}
}