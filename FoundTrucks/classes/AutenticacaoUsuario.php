<?php
    include "DaoUsuario.php";


    session_start();

    $email = isset($_POST['teEmail']) ? $_POST['teEmail'] : false;
    $senha = isset($_POST['teSenha']) ? $_POST['teSenha'] : false;
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
        <title>Autenticando Usuário</title>
        <script>
                function loginsuccessfully(){
                    setTimeout("window.location='AreaRestrita.php'", 5000);
                }

                function loginfailed(){
                    setTimeout("window.location='../teste.php'", 5000);
                    alert("Usuário ou senha incorretos.");
                }
        </script>
    </head>
    <body>

<?php

    $autentica;

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