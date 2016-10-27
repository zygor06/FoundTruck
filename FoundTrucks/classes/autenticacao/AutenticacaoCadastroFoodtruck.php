<?php

include "../Foodtruck.php";
include "../DaoFoodtruck.php";
include "../Debug.php";

$obFoodtruck;

$nome = isset($_POST['teNome']) ? $_POST['teNome'] : null;
$lat = isset($_POST['nrLat']) ? $_POST['nrLat'] : null;
$long = isset($_POST['nrLong']) ? $_POST['nrLong'] : null;
$usuario = isset($_POST['nrCpf']) ? $_POST['nrCpf'] : null;
$descricao = isset($_POST['teDescricao']) ? $_POST['teDescricao'] : null;
$imagem = isset($_POST['teImagem']) ? $_POST['teImagem'] : null;
$ativo = 1;


$obFoodtruck->setNome($nome);
$obFoodtruck->setLat($lat);
$obFoodtruck->setLong($long);
$obFoodtruck->setUsuario($usuario);
$obFoodtruck->setDescricao($descricao);
$obFoodtruck->setImagem($imagem);
$obFoodtruck->setAtivo($ativo);

//TE_NOME, NR_LAT, NR_LONG, NR_CPF_USUARIO, TE_DESCRICAO, TE_IMAGEM, CS_ATIVO 

if($obFoodtruck->verificaNull()){
    echo "<script>falha()</script>";
}

DaoFoodtruck::getInstance()->inserir($obFoodtruck);
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
            setTimeout("window.location='../../testeCadastroFoodtruck.php'", 3000);
            alert("Usuário ou senha incorretos.");
        }
    </script>
</head>
<body>

<?php

if($obFoodtruck){
    echo "<script>sucesso();</script>";
}else{
    echo"<script>falha()</script>";
}
?>
</body>
</html>