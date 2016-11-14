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
		
		<script src="/js/jquery.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-layers.min.js"></script>
		<script src="/js/init.js"></script>
		<script src="/js/script.js"></script>
		
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
			
		</noscript>

		<link rel="stylesheet" href="css/bootstrap.css" media="screen">
		
    </head>

    <body>
    	<?php include "../header_alt.php";
		include "../classes/DaoFoodtruck.php";					
		$arFoodTruck = DaoFoodTruck::getInstance()->buscarPorUsuario($cpf);
		$nrFoodTruck = DaoFoodTruck::getInstance()->contarFoodTrucks($cpf);
		?>        

<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Seja bem vindo, <?php echo $usuario; ?>!</h2>								
						<?php						
						if ($nrFoodTruck < 1) {
							echo '<h1>Você não possui foodtrucks cadastrados.</h1>'; 							
						} else {
							echo '<h1>Seus foodtrucks cadastrados são:</h1>';							
						}
						
						?>
					</header>

					<?php 
						$nrFoodTruck = DaoFoodTruck::getInstance()->contarFoodTrucks($cpf);
						if ($nrFoodTruck > 0) {
							foreach ($arFoodTruck as $row) {
							$nome = $row['TE_NOME'];						
							$descricao = $row['TE_DESCRICAO'];
							$imagem = $row['TE_IMAGEM'];
							$id = $row['NR_ID'];

							echo '
								<div class="row">
									<div class="col-md-12">
										<a href="/detalhes.html"><h4 class="tituloFoodtruck">'.$nome.'</h4></a>
										<p class="descricaoFoodtruck"><a href="/detalhes.html"><span class="image left"><img src="/images/foodtrucks/lista/logo'.$id.'.jpg" alt="" /></span></a>'.$descricao.'</p>										
										<ul class="actions">
											<!--<li><a href="#" class="button big">Fazer check-in</a></li>-->
											<li><a type="submit" class="button big">Fazer check-in</a></li>
										</ul>
									</div>
								</div>
							';
							}
						}						
					?>					
					
				</div>

			</section>

		<!-- Footer -->
			<?php include "../footer.php"; ?>
    </body>
</html>