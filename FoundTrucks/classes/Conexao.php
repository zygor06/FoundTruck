<?php 
//definindo as constantes de conexão

define('CONST_HOST', "localhost");
define('CONST_USER', "root");
define('CONST_PASSWORD', "");
define('CONST_DATABASE', "bd_found_truck");

class Conexao{

	public static $instance;

	private function __construct(){
		echo "Objeto criado";
	}

	public static function getInstance(){

		$config = 'mysql:host='.CONST_HOST.';dbname='.CONST_DATABASE.;

		if(!isset(self::$instance)){
			self::$instance = new PDO($config, CONST_USER, CONST_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;

	}

}



?>
