<?php 

class Foodtruck{

	private $teNome;
	private $nmLat;
	private $nmLong;
	private $teDescricao;
	private $teImagem;
	private $nmCpfUsuario;


	public setNome($nome){
		$this->teNome = $nome;
	}

	public getNome(){
		return $this->teNome;
	}

	public setLat($lat){
		$this->nmLat = $lat;
	}

	public getLat(){
		return $this->nmLat;
	}

	public setLong($long){
		$this->nmLong = $long;
	}

	public getLong(){
		return $this->nmLong;
	}

	public setDescricao($descricao){
		$this->teDescricao = $descricao;
	}

	public getDescricao(){
		return $this->teDescricao;
	}


	public setImagem($imagem){
		$this->teImagem = $imagem;
	}

	public getImagem(){
		return $this->teImagem;
	}

	public setCpfUsuario($cpfUsuario){
		$this->nmCpfUsuario = $cpfUsuario;
	}

	public getCpfUsuario(){
		return $this->cpfUsuario;
	}
	
}?>