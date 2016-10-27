<?php
include "classes/DaoUsuario.php";

$cars = DaoUsuario::getInstance ()->retornarTodos ();
?>

<html>
<head>
<meta charset="UTF-8" />
<title>Autenticando Usu�rio</title>

</head>
<body>

	<?php
	
	print_r($cars);
	
	?>

</body>
</html>
