<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Parceiros</title>

		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		

		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/script.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>

		<link rel="stylesheet" href="css/bootstrap.css" media="screen">		
			
		<script src="js/bootstrap.min.js"></script>

	</head>

	<body>

		<!-- Header -->
			<?php include "header_alt.php";
			include "classes/DaoFoodtruck.php";
			
			$arFoodTruck = DaoFoodTruck::getInstance()->listarFoodTrucks();

			//print_r($arFoodTruck);
			
			?>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Food Trucks</h2>
						<p>Aqui vocÃª encontra a lista de todos os Food Trucks que sÃ£o nossos parceiros</p>
					</header>

					<h4>Pesquisar</h4>
					<div class="6u 12u$(4)">
						<input type="text" name="name" id="name" value="" placeholder="Name" />
						<br>
					</div>

					<!-- <h4>Filtrar por tipo</h4>
					<div class="6u$ 12u$(4)">
						<div class="select-wrapper">
							<select name="category" id="category">
								<option value="">Listar tipos</option>
								<option value="1">Tipo 1</option>
								<option value="1">Tipo 2</option>
								<option value="1">Tipo 3</option>
								<option value="1">Tipo 4</option>
								<option value="1">Tipo 5</option>
								<option value="1">Tipo 6</option>
							</select>
						</div>
						<br>
					</div> -->

					<?php 

						foreach ($arFoodTruck as $row) {
							$nome = $row['TE_NOME'];						
							$descricao = $row['TE_DESCRICAO'];
							$imagem = $row['TE_IMAGEM'];

							echo '
								<div class="row">
									<div class="col-md-12">
										<a href="detalhes.html"><h4 class="tituloFoodtruck">'.$nome.'</h4></a>
										<p class="descricaoFoodtruck"><a href="detalhes.html"><span class="image left"><img src="images/foodtrucks/logo/logo1.jpg" alt="" /></span></a>'.$descricao.'</p>
									</div>
								</div>


							';
						}
					?>
					
					<!-- <br><br><br><br><br><br>
					<ul class="pagination">
						<li><a href="#">Â«</a></li>
						<li><a class="active" href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">Â»</a></li>
					</ul> -->

				</div>

			</section>

		<!-- Footer -->
			<?php include "footer.php"; ?>

	</body>
</html>