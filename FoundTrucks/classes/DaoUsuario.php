<?php

require_once "Conexao.php";
require_once "GeraLog.php";
require_once "Usuario.php";

class DaoUsuario{

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DaoUsuario();

        return self::$instance;
    }

    public function Inserir(Usuario $obUsuario) {
        try {
            $stSql = "INSERT INTO TB_USUARIO (		
                TE_NOME,
                TE_EMAIL,
                TE_SENHA,
                CS_ATIVO, 
                VALUES (
                :TE_NOME,
                :TE_EMAIL,
                :TE_SENHA,
                :CS_ATIVO";

            $obSql = Conexao::getInstance()->prepare($stSql);

            $obSql->bindValue(":TE_NOME", $obUsuario->getNome());
            $obSql->bindValue(":TE_EMAIL", $obUsuario->getEmail());
            $obSql->bindValue(":TE_SENHA", $obUsuario->getSenha());
            $obSql->bindValue(":CS_ATIVO", $obUsuario->getAtivo());


            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Editar(Usuario $obUsuario) {
        try {
            $stSql = "UPDATE TB_USUARIO set
				TE_NOME = :TE_NOME,
                TE_EMAIL = :TE_EMAIL,
                TE_SENHA = :TE_SENHA,
                CS_ATIVO = :CS_ATIVO

                WHERE NM_CPF = :NM_CPF";

            $obSql = Conexao::getInstance()->prepare($stSql);

            $obSql->bindValue(":TE_NOME", $obUsuario->getNome());
            $obSql->bindValue(":TE_EMAIL", $obUsuario->getEmail());
            $obSql->bindValue(":TE_SENHA", $obUsuario->getSenha());
            $obSql->bindValue(":CS_ATIVO", $obUsuario->getAtivo());
            $obSql->bindValue(":NM_CPF", $obUsuario->getCPF());

            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Deletar($nmCPF) {
        try {
            $stSql = "DELETE FROM TB_USUARIO WHERE NM_CPF = :cpf";
            $obSql = Conexao::getInstance()->prepare($stSql);
            $obSql->bindValue(":cpf", $nmCPF);

            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function BuscarPorCPF($nmCPF) {
        try {
            $stSql = "SELECT * FROM TB_USUARIO WHERE NM_CPF = :cpf";
            $obSql = Conexao::getInstance()->prepare($stSql);
            $obSql->bindValue(":cpf", $nmCPF);
            $obSql->execute();
            return $this->populaUsuario($obSql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

	private function populaUsuario($arRow) {
        $obPojo = new Usuario;
        $obPojo->setCPF($arRow['NM_CPF']);
        $obPojo->setNome($arRow['TE_NOME']);
        $obPojo->setEmail($arRow['TE_EMAIL']);
        $obPojo->setSenha($arRow['TE_SENHA']);
        $obPojo->setAtivo($arRow['CS_ATIVO']);

        return $obPojo;
    }

}

?>