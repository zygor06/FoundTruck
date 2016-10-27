<html>
    <head>
        <meta>
        <title>Cadastro de Usuário</title>
        <style>
            label{
                display: inline-block;
                width:100px;
                text-align: right;
            }
        </style>
    </head>
    <body>
        <form name="formCadastro" method="post" action="classes/autenticacao/AutenticacaoCadastro.php">
            <fieldset>
                <legend>Cadastro</legend>
                <label>CPF: </label><input type="text" name="nrCpf" /><br />
                <label>Nome: </label><input type="text" name="teNome" /><br />
                <label>E-mail: </label><input type="text" name="teEmail" /><br />
                <label>Senha: </label><input type="password" name="teSenha" /><br />
                <label>Confirmar Senha: </label><input type="password" name="confSenha" /><br />
                <input type="submit" value="confirmar" />
            </fieldset>

        </form>
    </body>

</html>

