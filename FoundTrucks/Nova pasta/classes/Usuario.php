<?php

define('CONST_ATIVO', 1);
define('CONST_INATIVO', 0);

class Usuario {

    private $nrCPF;
    private $teNome;
    private $teEmail;
    private $teSenha;
    private $csAtivo;

    public function getCpf() {
        return $this->nrCPF;
    }

    public function setCpf($nrCPF) {
        $this->nrCPF = $nrCPF;
    }

    public function getNome() {
        return $this->teNome;
    }

    public function setNome($teNome) {
        $this->teNome = $teNome;
    }

    public function getEmail() {
        return $this->teEmail;
    }

    public function setEmail($teEmail) {
        $this->teEmail = strtolower($teEmail);
    }

    public function getSenha() {
        return $this->teSenha;
    }

    public function setSenha($teSenha) {
        $this->teSenha = strtolower($teSenha);
    }

    public function getAtivo() {
        return $this->csAtivo;
    }

    public function setAtivo($csAtivo) {
        if($csAtivo){
            $this->csAtivo = CONST_ATIVO;
        }else{

        }

    }

}

?>