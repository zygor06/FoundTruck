<?php 
//definindo as constantes de conexão

define('CONST_HOST', "localhost");
define('CONST_USER', "root");
define('CONST_PASSWORD', "");
define('CONST_DATABASE', "bd_found_truck");

class Conexao{

	var $query;
	var $link;
	var $result;

	function __construct(){
		echo "Objeto criado <br  />";
	}

	function connect(){
		$this->link = mysql_connect(CONST_HOST, CONST_USER, CONST_PASSWORD);
		echo "Conectado";

		if(!$this->link){
			echo "Falha na conexao com o Bando de Dados!<br />";
			echo "Erro: " . mysql_error();
			die();
		}else if(!mysql_select_db(CONST_DATABASE, $this->link)){
			echo "O Banco de Dados solicitado não pode ser aberto!<br />";
			echo "Erro: " . mysql_error();
			die();
		}
	}

	function disconnect(){
		return mysql_close($this->link);
	}

	function executeQuery($query){
		$this->connect();
		$this->query = $query;

		if($this->result = mysql_query($this->query)){
			$this->disconnect();
			return $this->result;
		}else{
			echo "Ocorreu um erro na execução da SQL";
			echo "Erro :" . mysql_error();
			die();
			disconnect();
		}
	}

}
