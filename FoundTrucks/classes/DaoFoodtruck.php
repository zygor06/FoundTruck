<?php

require_once "Conexao.php";
require_once "GeraLog.php";
require_once "Foodtruck.php";

class DaoFoodtruck{

	public static $instance;

	private function __construct() {
		//
	}

	public static function getInstance() {
		if (!isset(self::$instance))
			self::$instance = new DaoFoodtruck();

			return self::$instance;
	}

	public function Inserir(Foodtruck $obFoodtruck) {
		try {
			$stSql = "INSERT INTO TB_FOODTRUCK (TE_NOME, NR_LAT, NR_LONG, NR_CPF_USUARIO, TE_DESCRICAO,	TE_IMAGEM, CS_ATIVO)
                VALUES (:TE_NOME, :NR_LAT, :NR_LONG, :NR_CPF_USUARIO, :TE_DESCRICAO, :TE_IMAGEM, :CS_ATIVO)";

			$obSql = Conexao::getInstance()->prepare($stSql);
			
			$obSql->bindValue(":TE_NOME", $obFoodtruck->getNome());
			$obSql->bindValue(":NR_LAT", $obFoodtruck->getLat());
			$obSql->bindValue(":NR_LONG", $obFoodtruck->getLong());
			$obSql->bindValue(":NR_CPF_USUARIO", $obFoodtruck->getCpfUsuario());
			$obSql->bindValue(":TE_DESCRICAO", $obFoodtruck->getDescricao());
			$obSql->bindValue(":TE_IMAGEM", $obFoodtruck->getImagem());
			$obSql->bindValue(":CS_ATIVO", $obFoodtruck->getAtivo());

			return $obSql->execute();

			print("Inserido com sucesso no banco!");
		} catch (Exception $e) {
			echo gethostbyname("host.name.tld");
			print($e->getMessage());
		}
	}

	public function Editar(Foodtruck $obFoodtruck) {
		try {
			$stSql = "UPDATE TB_FOODTRUCK set
				TE_NOME = :TE_NOME,
                TE_EMAIL = :TE_EMAIL,
                TE_SENHA = :TE_SENHA,
                CS_ATIVO = :CS_ATIVO
                WHERE NR_CPF_USUARIO = :NR_CPF_USUARIO AND TE_NOME = :TE_NOME";

			$obSql = Conexao::getInstance()->prepare($stSql);

			$obSql->bindValue(":TE_NOME", $obFoodtruck->getNome());
			$obSql->bindValue(":TE_EMAIL", $obFoodtruck->getEmail());
			$obSql->bindValue(":TE_SENHA", $obFoodtruck->getSenha());
			$obSql->bindValue(":CS_ATIVO", $obFoodtruck->getAtivo());
			$obSql->bindValue(":NR_CPF", $obFoodtruck->getCPF());

			return $obSql->execute();
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}


	public function Checkin($nome, $nrCPF, $lat, $long) {
		try {
			$stSql = "UPDATE TB_FOODTRUCK set
				NR_LAT = :NR_LAT,
                NR_LONG = :NR_LONG,                
                CS_ATIVO = '1'
                WHERE NR_CPF_USUARIO = :NR_CPF_USUARIO AND TE_NOME = :TE_NOME";

			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":TE_NOME", $nome);			
			$obSql->bindValue(":NR_CPF_USUARIO", $nrCPF);
			$obSql->bindValue(":NR_LAT", $lat);
			$obSql->bindValue(":NR_LONG", $long);

			return $obSql->execute();
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}

	public function Deletar($nrCPF) {
		try {
			$stSql = "DELETE FROM TB_FOODTRUCK WHERE NR_CPF_USUARIO = :NR_CPF_USUARIO AND TE_NOME = :TE_NOME";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":NR_CPF_USUARIO", $nrCPF);

			return $obSql->execute();
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}

	public function buscarPorUsuario($nrCPF) {
		try {
			$stSql = "SELECT * FROM TB_FOODTRUCK WHERE NR_CPF_USUARIO = :NR_CPF_USUARIO";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":NR_CPF_USUARIO", $nrCPF);
			$obSql->execute();
			// return $this->populaFoodtruck($obSql->fetch(PDO::FETCH_ASSOC));
			// return $obSql->fetchAll(PDO::FETCH_ASSOC);
			return $obSql->fetchAll();
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}

    public function retornarLatLong() {
    	try {
    		$stSql = "SELECT TB_FOODTRUCK.TE_NOME, TB_FOODTRUCK.NR_LAT, TB_FOODTRUCK.NR_LONG, TB_ALIMENTO.TE_ALIMENTO, TE_DESCRICAO FROM 
			TB_FOODTRUCK JOIN TB_VENDE JOIN TB_ALIMENTO ON TB_FOODTRUCK.NR_ID = TB_VENDE.TB_FOODTRUCK_NR_ID AND TB_VENDE.TB_ALIMENTO_NR_ID = 
			TB_ALIMENTO.NR_ID WHERE TB_FOODTRUCK.CS_ATIVO = '1';";
    
    		$obSql = Conexao::getInstance()->prepare($stSql);    
    		$obSql->execute();
    		
    		return $obSql->fetchAll(PDO::FETCH_ASSOC);
    		
    	} catch (Exception $e) {
    		print($e->getMessage());
    	}
    }
    
    public function recuperaPorId($id) {
    	try {
    		$stSql = "SELECT * FROM TB_FOODTRUCK WHERE NR_ID = :NR_ID;";
    		$obSql = Conexao::getInstance()->prepare($stSql);
    		$obSql->bindValue(":NR_ID", $id);  
    		
    		$obSql->execute();
    
    		return $obSql->fetchAll();
    
    	} catch (Exception $e) {
    		print($e->getMessage());
    	}
    }

	
	public function listarFoodTrucks() {
		try {
			$stSql = "SELECT * FROM TB_FOODTRUCK ORDER BY TE_NOME";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->execute();

			return $obSql->fetchAll();
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}


	public function contarFoodTrucks($nrCPF) {
		try {
			$stSql = "SELECT COUNT(TE_NOME) FROM TB_FOODTRUCK WHERE NR_CPF_USUARIO = :NR_CPF_USUARIO";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":NR_CPF_USUARIO", $nrCPF);
			$obSql->execute();
			return $obSql->fetchColumn(0);
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}
	
	private function populaFoodtruck($arRow) {
		$obTemp = new Foodtruck;
		
		$obTemp->setId($arRow['NR_ID']);
		$obTemp->setNome($arRow['TE_NOME']);
		$obTemp->setLat($arRow['NR_LAT']);
		$obTemp->setLong($arRow['NR_LONG']);
		$obTemp->setUsuario($arRow['NR_CPF_USUARIO']);
		$obTemp->setDescricao($arRow['TE_DESCRICAO']);
		$obTemp->setImagem($arRow['TE_IMAGEM']);
		$obTemp->setAtivo($arRow['CS_ATIVO']);

		carrega();

		return $obTemp;
	}
	
	private function carrega(){
		echo '				';
	}
}

?>