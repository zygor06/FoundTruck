<?php

//Vari�veis do m�todo POST
$teNome = $_POST['nome'];
$teEmail = $_POST['email_contato'];
$teAssunto = $_POST['assunto'];
$teTexto = $_POST['texto'];
$dtData_envio = date('d/m/y');

//Informa��es do destinat�rio
$teEmail_destino = "foundtruck@foundtruck.com";

//Informa��es mail
$teCaracter = "MIME-Version 1.0 \n";
$teContentType = "Content-type: text/plain; charset=iso-8859-1\n";

//Header
$headers = $teCaracter;
$headers = $teContentType;
$headers = $teEmail;

		
//Envia email
$boEnviaEmail = mail($teEmail_destino, $teAssunto, $teTexto, $headers);

if($boEnviaEmail){
	echo "<script type='text/javascript'> alert('Email enviado com sucesso!')</script>";
} else {
	echo "<script type='text/javascript'> alert('Falha no envio')</script>";
}
?>
