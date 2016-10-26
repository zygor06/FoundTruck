<?php 

//definindo as constantes de conexão

define('CONST_HOST', "localhost");
define('CONST_USER', "root");
define('CONST_PASSWORD', "root");
define('CONST_DATABASE', "BD_FOUNDTRUCK");

class Conexao{

	public static $instance;

	private function __construct(){
	}

	public static function getInstance(){

		if(!isset(self::$instance)){
			self::$instance = new PDO('mysql:host=localhost;dbname=DB_FOUNDTRUCK', CONST_USER, CONST_PASSWORD);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;

	}

}



?>
