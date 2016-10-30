<?php
include "classes/DaoFoodtruck.php";

$foodtrucks = DaoFoodtruck::getInstance ()->retornarLatLong();
?>

<html>
<head>
<meta charset="UTF-8" />
<title>Teste Retorno</title>

</head>
<body>

	<?php 

		for($i = 0; $i < count($foodtrucks[0]) ; $i++){
			$nome = $foodtrucks[$i]['TE_NOME'];
			$lat = $foodtrucks[$i]['NR_LAT'];
			$long = $foodtrucks[$i]['NR_LONG'];
			$alimento = $foodtrucks[$i]['TE_ALIMENTO'];

			echo "$nome: latitude: $lat, longitude: $long, alimento: $alimento";
			echo "<br>";

		}

	?>

</body>
</html>
