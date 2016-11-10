<?php
    session_start();

    $usuario = $_SESSION['teUsuario'];
    $cpf = $_SESSION['cpf'];

?>

<html>
    <head>
        <title>Área Restrita</title>

		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		

		<script src="../js/jquery.min.js"></script>
		<script src="../js/skel.min.js"></script>
		<script src="../js/skel-layers.min.js"></script>
		<script src="../js/init.js"></script>
		<script src="../js/script.js"></script>

		<noscript>
			<link rel="stylesheet" href="../css/skel.css" />
			<link rel="stylesheet" href="../css/style.css" />
			<link rel="stylesheet" href="../css/style-xlarge.css" />
		</noscript>

		<link rel="stylesheet" href="../css/bootstrap.css" media="screen">		
			
		<script src="../js/bootstrap.min.js"></script>
    </head>

    <body>
    	<?php include "../header_alt.php";
		include "../classes/DaoFoodtruck.php";			
		// $arFoodTruck = DaoFoodTruck::getInstance()->listarFoodTrucks();
		$arFoodTruck = DaoFoodTruck::getInstance()->buscarPorUsuario($cpf);
		?>
        <h1>Seja bem Vindo <?php echo $usuario; ?></h1>

<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h1>Seja bem Vindo <?php echo $usuario; ?></h1>				
					</header>

					<?php 

						foreach ($arFoodTruck as $row) {
							$nome = $row['TE_NOME'];						
							$descricao = $row['TE_DESCRICAO'];
							$imagem = $row['TE_IMAGEM'];

							echo '
								<div class="row">
									<div class="col-md-12">
										<a href="../detalhes.html"><h4 class="tituloFoodtruck">'.$nome.'</h4></a>
										<p class="descricaoFoodtruck"><a href="../detalhes.html"><span class="image left"><img src="../images/foodtrucks/logo/logo1.jpg" alt="" /></span></a>'.$descricao.'</p>
									</div>
								</div>

							';
						}
					?>
					
					
				</div>

			</section>

		<!-- Footer -->
			<?php include "../footer.php"; ?>


    </body>
</html>
