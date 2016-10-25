<?php

class Alimento {

    private $teAlimento;
    private $teImagem;

    public setAlimento($alimento){
        $this->teAlimento = $alimento;
    }

    public getAlimento(){
        return $this->alimento;
    }

    public setImagem($imagem){
        $this->teImagem = $imagem;
    }

    public getImagem(){
        return $this->imagem;
    }

}?>