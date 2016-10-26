<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <style type="text/css">
            *{
                margin:20px;
            }
        </style>
    </head>
    <body>
        <h2>Formulário de Login</h2>
        <form name="formlogin" method="post" action="classes/AutenticacaoUsuario.php">
            <label>E-mail: </label><input type="text"  name="teEmail"/><br/>
            <label>Senha: </label><input type="password" name="teSenha" /><br/>
            <input type="submit" value="entrar" />
        </form>
    </body>
</html>

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
