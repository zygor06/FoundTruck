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
			print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde<br />.";
			print("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
		}
	}

	public function Editar(Foodtruck $obFoodtruck) {
		try {
			$stSql = "UPDATE TB_FOODTRUCK set
				TE_NOME = :TE_NOME,
                TE_EMAIL = :TE_EMAIL,
                TE_SENHA = :TE_SENHA,
                CS_ATIVO = :CS_ATIVO

                WHERE NR_CPF = :NR_CPF";

			$obSql = Conexao::getInstance()->prepare($stSql);

			$obSql->bindValue(":TE_NOME", $obFoodtruck->getNome());
			$obSql->bindValue(":TE_EMAIL", $obFoodtruck->getEmail());
			$obSql->bindValue(":TE_SENHA", $obFoodtruck->getSenha());
			$obSql->bindValue(":CS_ATIVO", $obFoodtruck->getAtivo());
			$obSql->bindValue(":NR_CPF", $obFoodtruck->getCPF());

			return $obSql->execute();
		} catch (Exception $e) {
			print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
			GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
		}
	}

	public function Deletar($nrCPF) {
		try {
			$stSql = "DELETE FROM TB_FOODTRUCK WHERE NR_CPF = :cpf";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":cpf", $nrCPF);

			return $obSql->execute();
		} catch (Exception $e) {
			print "Ocorreu um erro ao tentar executar esta a��o, foi gerado um LOG do mesmo, tente novamente mais tarde.";
			GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
		}
	}

	public function BuscarPorUsuario($nrCPF) {
		try {
			$stSql = "SELECT * FROM TB_FOODTRUCK WHERE NR_CPF = :cpf";
			$obSql = Conexao::getInstance()->prepare($stSql);
			$obSql->bindValue(":cpf", $nrCPF);
			$obSql->execute();
			return $this->populaFoodtruck($obSql->fetch(PDO::FETCH_ASSOC));
		} catch (Exception $e) {
			print "Ocorreu um erro ao tentar executar esta a��o, foi gerado um LOG do mesmo, tente novamente mais tarde.";
			GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
		}
	}

	private function populaFoodtruck($arRow) {
		$obTemp = new Foodtruck;
		//TE_NOME, NR_LAT, NR_LONG, NR_CPF_USUARIO, TE_DESCRICAO,	TE_IMAGEM, CS_ATIVO
		
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
		echo '
				
				
				';
	}

}

?>