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
        <form name="formlogin" method="post" action="classes/autenticacao/AutenticacaoUsuario.php">
            <label>E-mail: </label><input type="text"  name="teEmail"/><br/>
            <label>Senha: </label><input type="password" name="teSenha" /><br/>
            <input type="submit" value="entrar" />
        </form>
    </body>
</html>