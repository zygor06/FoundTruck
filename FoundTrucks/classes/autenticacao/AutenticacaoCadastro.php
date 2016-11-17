<?php

include "../Usuario.php";
include "../DaoUsuario.php";
include "../Debug.php";

$obUsuario;

$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;

$obUsuario = new Usuario();
$obUsuario->setCpf($cpf);
$obUsuario->setNome($nome);
$obUsuario->setEmail($email);
$obUsuario->setSenha($senha);
$obUsuario->setAtivo(1);

if($obUsuario->verificaNull()){
    echo "<script>falha()</script>";
}

DaoUsuario::getInstance()->inserir($obUsuario);
?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Autenticando Cadastro</title>
    <script>
        function sucesso(){
            setTimeout("window.location='../../index.php'", 3000);
        }

        function falha(){
            setTimeout("window.location='../../testeCadastro.php'", 3000);
            alert("Usuário ou senha incorretos.");
        }
    </script>
</head>
<body>

<?php

if($obUsuario){
    echo "<script>sucesso();</script>";
}else{
    echo"<script>falha()</script>";
}
?>
</body>
</html>