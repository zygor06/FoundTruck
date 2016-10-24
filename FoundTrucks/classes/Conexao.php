<?php 

//Verificação de segurança
$url  = $SERVER["PHP_SELF"];

if(eregi("class.Upload.php", "$url")){
	header("Location: ../index.php");
}

//definindo as constantes de conexão

define('CONST_HOST', "");
define('CONST_USER', "");
define('CONST_PASSWORD', "");
define('CONST_DATABASE', "");

class Conexao{

	var $query;
	var $link;
	var $result;

	function Conexao(){

	}

	function connect(){
		$this->link = mysql_connect(CONST_HOST, CONST_USER, CONST_PASSWORD);

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
