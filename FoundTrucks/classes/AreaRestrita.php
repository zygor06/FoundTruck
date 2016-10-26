<?php

    $usuario = $_SESSION['teUsuario'];

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title>Área Restrita</title>
    </head>

    <body>
        <h1>Seja bem Vindo <?php echo $usuario; ?></h1>
    </body>
</html>
