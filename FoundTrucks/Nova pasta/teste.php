<?php

include 'classes/Usuario.php' ;
include 'classes/DaoUsuario.php';

$obUsuario = new Usuario();

$obUsuario->setNome("Hygor");
$obUsuario->setCpf("05291657162");
$obUsuario->setEmail("hygor@dias.com");
$obUsuario->setSenha("Nemteconto12");
$obUsuario->setAtivo(TRUE);

$arAtributos = array(

    'NR_CPF' => $obUsuario->getCpf(),
    'TE_NOME' => $obUsuario->getNome(),
    'TE_EMAIL' => $obUsuario->getEmail(),
    'TE_SENHA' => $obUsuario->getSenha(),
    'CS_ATIVO' => $obUsuario->getAtivo()
);


DaoUsuario::getInstance()->inserir($obUsuario);

?>