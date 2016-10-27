<?php
include "../DaoUsuario.php";

if(basename($_SERVER["PHP_SELF"])==basename(__FILE__) )
    exit("<script>alert('Nao permitido')</script>\n<script>window.location=('../../index.php')</script>");

session_start();

if (!isset($_SESSION['admin'])){
    return header('../../index.php');
} elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == false) {
    return header('../../areaRestrita/index.php');
}

$email = isset($_POST['teEmail']) ? $_POST['teEmail'] : null;
$senha = isset($_POST['teSenha']) ? $_POST['teSenha'] : null;
$teUsuario;

try{
    $obUsuario = DaoUsuario::getInstance()->BuscarPorEmail($email);
}catch(Exception $e){
    die();
}
?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Autenticando Usu�rio</title>
    <script>
        function loginsuccessfully(){
            setTimeout("window.location='../../AreaRestrita/index.php'", 5000);
        }

        function loginfailed(){
            setTimeout("window.location='../../testeLogin.php'", 5000);
            alert("Usuário ou senha incorretos.");
        }
    </script>
</head>
<body>

<?php

if($email == $obUsuario->getEmail() && $senha == $obUsuario->getSenha()){
    $_SESSION["teEmail"] = $_POST["teEmail"];
    $_SESSION["teSenha"] = $_POST["teSenha"];
    $_SESSION["teUsuario"] = $obUsuario->getNome();
    echo "<script>loginsuccessfully();</script>";
}else{
    echo "<script>loginfailed();</script>";
}
?>
</body>
</html>