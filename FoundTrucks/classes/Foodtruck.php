<?php

define('CONST_ATIVO', 1);
define('CONST_INATIVO', 0);

class Foodtruck{

	private $nrId;
	private $teNome;
	private $nmLat;
	private $nmLong;
	private $teDescricao;
	private $teImagem;
	private $nrCpfUsuario;
	private $csAtivo;

	public function setId($id){
		$this->nrId = $id;
	}
	
	public function getId(){
		return $this->nrId;
	}
	
	public function setNome($nome){
		$this->teNome = $nome;
	}

	public function getNome(){
		return $this->teNome;
	}

	public function setLat($lat = null){
		$this->nmLat = $lat;
	}

	public function getLat(){
		return $this->nmLat;
	}

	public function setLong($long = null){
		$this->nmLong = $long;
	}

	public function getLong(){
		return $this->nmLong;
	}

	public function setDescricao($descricao){
		$this->teDescricao = $descricao;
	}

	public function getDescricao(){
		return $this->teDescricao;
	}


	public function setImagem($imagem){
		$this->teImagem = $imagem;
	}

	public function getImagem(){
		return $this->teImagem;
	}

	public function setCpfUsuario($cpfUsuario){
		$this->nrCpfUsuario = $cpfUsuario;
	}

	public function getCpfUsuario(){
		return $this->nrCpfUsuario;
	}
	
	public function setAtivo($csAtivo) {
		if($csAtivo){
			$this->csAtivo = CONST_ATIVO;
		}else{
			$this->csAtivo = CONST_INATIVO;
		}
	}
	
	public function getAtivo(){
		return $this->csAtivo;
	}
	
	public function verificaNull(){
		return true;
	}
	
}?>