<?php

define('CONST_ATIVO', 1);
define('CONST_INATIVO', 0);

class Usuario {

    private $nmCPF;
    private $teNome;
    private $teEmail;
    private $teSenha;
    private $csAtivo;

    public function getNmCPF() {
        return $this->nmCPF;
    }

    public function setNmCPF($nmCPF) {
        $this->nmCPF = $nmCPF;
    }

    public function getTeNome() {
        return $this->teNome;
    }

    public function setTeNome($teNome) {
        $this->teNome = $teNome;
    }

    public function getTeEmail() {
        return $this->teEmail;
    }

    public function setTeEmail($teEmail) {
        $this->teEmail = strtolower($teEmail);
    }

    public function getTeSenha() {
        return $this->teSenha;
    }

    public function setTeSenha($teSenha) {
        $this->teSenha = strtolower($teSenha);
    }    
    
    public function getCsAtivo() {
        return $this->csAtivo;
    }

    public function setCsAtivo($csAtivo) {
        $this->csAtivo = strtolower($csAtivo);
    }

}

?>