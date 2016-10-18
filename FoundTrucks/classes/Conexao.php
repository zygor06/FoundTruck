<?php 

require_once 'Objeto.class.php';

class Conexao extends Objeto {
	
	private $obConexao;
	private $nmBanco;
	private $nrIpBanco;
	private $nrPorta;
	private $nmUsuario;
	private $teSenha;
	
	function __construct(){
		
	}
}