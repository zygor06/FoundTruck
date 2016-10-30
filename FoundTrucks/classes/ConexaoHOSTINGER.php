<?php 

//definindo as constantes de conexão

define('CONST_HOST', "mysql.hostinger.com.br");
define('CONST_USER', "u609984080_root");
define('CONST_PASSWORD', "lighting");
define('CONST_DATABASE', "u609984080_found");

class Conexao{

	public static $instance;

	private function __construct(){
	}

	public static function getInstance(){

		if(!isset(self::$instance)){
			self::$instance = new PDO('mysql:host=mysql.hostinger.com.br;dbname=u609984080_found', CONST_USER, CONST_PASSWORD);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;

	}

}



?>
