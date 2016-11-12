<?php 

//definindo as constantes de conexão

define('CONST_HOST', "mysql.hostinger.com.br");
define('CONST_USER', "u408929514_fdtrk");
define('CONST_PASSWORD', "projetoweb16");
define('CONST_DATABASE', "u408929514_fdtrk");

class Conexao{

	public static $instance;

	private function __construct(){
	}

	public static function getInstance(){

		if(!isset(self::$instance)){
			self::$instance = new PDO('mysql:host='.CONST_HOST.';dbname='.CONST_DATABASE, CONST_USER, CONST_PASSWORD);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;

	}

}



?>
