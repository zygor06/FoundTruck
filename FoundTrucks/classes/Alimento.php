<?php

class Alimento {

    private $teAlimento;
    private $teImagem;

    function setAlimento($alimento){
        $this->teAlimento = $alimento;
    }

    public function getAlimento(){
        return $this->alimento;
    }

    public function setImagem($imagem){
        $this->teImagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }

}?>