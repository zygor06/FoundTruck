<?php
include "../DaoUsuario.php";

session_start();

$email = isset($_POST['teEmail']) ? $_POST['teEmail'] : null;
$senha = isset($_POST['teSenha']) ? $_POST['teSenha'] : null;
$teUsuario;

try{
    $obUsuario = DaoUsuario::getInstance()->BuscarPorEmail($email);
}catch(Exception $e){
    die();
}

echo "Autenticando";

?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Autenticando Usu�rio</title>
    <script>
        function loginsuccessfully(){
            setTimeout("window.location='../../AreaRestrita/index.php'", 2000);
        }

        function loginfailed(){
            setTimeout("window.location='../../index.php'", 2000);
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