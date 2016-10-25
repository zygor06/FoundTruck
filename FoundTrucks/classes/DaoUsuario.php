<?php

require_once "Conexao.php";
require_once "GeraLog.php";
require_once "PojoUsuario.php";

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

    public function Inserir(PojoUsuario $obUsuario) {
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

            $obSql->bindValue(":TE_NOME", $obUsuario->getTeNome());
            $obSql->bindValue(":TE_EMAIL", $obUsuario->getTeEmail());
            $obSql->bindValue(":TE_SENHA", $obUsuario->getTeSenha());
            $obSql->bindValue(":CS_ATIVO", $obUsuario->getCsAtivo());


            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Editar(PojoUsuario $obUsuario) {
        try {
            $stSql = "UPDATE TB_USUARIO set
				TE_NOME = :TE_NOME,
                TE_EMAIL = :TE_EMAIL,
                TE_SENHA = :TE_SENHA,
                CS_ATIVO = :CS_ATIVO

                WHERE NM_CPF = :NM_CPF";

            $obSql = Conexao::getInstance()->prepare($stSql);

            $obSql->bindValue(":TE_NOME", $obUsuario->getTeNome());
            $obSql->bindValue(":TE_EMAIL", $obUsuario->getTeEmail());
            $obSql->bindValue(":TE_SENHA", $obUsuario->getTeSenha());
            $obSql->bindValue(":CS_ATIVO", $obUsuario->getCsAtivo());
            $obSql->bindValue(":NM_CPF", $obUsuario->getNmCPF());

            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function Deletar($nmCPF) {
        try {
            $stSql = "DELETE FROM TB_USUARIO WHERE NM_CPF = :cod";
            $obSql = Conexao::getInstance()->prepare($stSql);
            $obSql->bindValue(":cod", $nmCPF);

            return $obSql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function BuscarPorCOD($nmCPF) {
        try {
            $stSql = "SELECT * FROM TB_USUARIO WHERE NM_CPF = :cod";
            $obSql = Conexao::getInstance()->prepare($stSql);
            $obSql->bindValue(":NM_CPF", $nmCPF);
            $obSql->execute();
            return $this->populaUsuario($obSql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

	private function populaUsuario($arRow) {
        $obPojo = new PojoUsuario;
        $obPojo->setNmCPF($arRow['NM_CPF']);
        $obPojo->setTeNome($arRow['TE_NOME']);
        $obPojo->setTeEmail($arRow['TE_EMAIL']);
        $obPojo->setTeSenha($arRow['TE_SENHA']);
        $obPojo->setCsAtivo($arRow['CS_ATIVO']);

        return $obPojo;
    }

}

?>