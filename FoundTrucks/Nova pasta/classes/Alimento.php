<?php

class Alimento {

    private $teNome;
    private $teImagem;

    function setNome($alimento){
        $this->teNome = $alimento;
    }

    public function getNome(){
        return $this->alimento;
    }

    public function setImagem($imagem){
        $this->teImagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }

}?>