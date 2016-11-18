<?php 

//definindo as constantes de conexÃ£o

define('CONST_HOST', "mysql.hostinger.com.br");
define('CONST_USER', "u535880461_admin");
define('CONST_PASSWORD', "uShlSI7GMf");
define('CONST_DATABASE', "u535880461_db");

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
