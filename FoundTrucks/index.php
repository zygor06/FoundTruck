


<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Found Truck</title>
<link rel="icon" href="images/logo.png"> 

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

<body class="landing">

	<!-- Header -->
	<?php include "header.php"?>	

	<!-- Banner -->
	<section id="banner">
		<h2>Olá. Este é o Found Truck.</h2>
		<p>Localize seu FoodTruck preferido em apenas um clique.</p>
		<ul class="actions">
			<li><a href="#two" class="button big">Rastreio Rápido</a></li>
		</ul>
	</section>

	<!-- One -->
	<section id="one" class="wrapper style1 special">
		<div class="container">

			<header class="major">
				<h2>Sua fome não pode esperar</h2>
				<p>
					Encontre o <strong>FoodTruck</strong> mais próximo de você já!
				</p>
			</header>
			<div class="row 150%">
				<div class="4u 12u$(medium)">
					<section class="box">
						<i class="icon big rounded color1 icon-map-marker"></i>
						<h3>Localização em tempo real</h3>
						<p>Veja onde se encontra seu foodtruck favorito ou qual é o mais
							próximo de você.</p>
					</section>
				</div>
				<div class="4u 12u$(medium)">
					<section class="box">
						<i class="icon big rounded color9 icon-food"></i>
						<h3>Comida para todos os gostos.</h3>
						<p>Diversos tipos de cardápios para você se deliciar.</p>
					</section>
				</div>
				<div class="4u$ 12u$(medium)">
					<section class="box">
						<i class="icon big rounded color6 icon-truck"></i>
						<h3>Diversos parceiros</h3>
						<p>Com nosso site, você poderá desfrutar de vários tipos de
							comida.</p>
					</section>
				</div>
			</div>
		</div>
	</section>

	<!-- Two -->
			<?php
			include "classes/DaoFoodtruck.php";
			$foodtrucks = DaoFoodtruck::getInstance ()->retornarLatLong ();
			?>
			<!-- <section id="two" class="wrapper style2 special">				 -->
	<section id="two">
		<div id="map"></div>

		<link href='css/mapa.css' rel='stylesheet' type='text/css'>
		<p id="geo"></p>
		<?php include "js/mapa.php";?>
		<script
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmrExWndfKz7CdR7vZADNbCbKj7GgX4So"></script>
	</section>

	<!-- Footer -->
	<?php include "footer.php"; ?>
	<!-- End Footer -->

	<!-- Classe com imagens para serem carregadas em buffer -->
	<div class="hide">
		<img src="images/banner/img1.jpg" alt="image1" /> <img
			src="images/banner/img2.jpg" alt="image2" /> <img
			src="images/banner/img3.jpg" alt="image3" /> <img
			src="images/banner/img4.jpg" alt="image4" /> <img
			src="images/banner/img5.jpg" alt="image5" /> <img
			src="images/banner/img6.jpg" alt="image6" /> <img
			src="images/banner/img7.jpg" alt="image7" /> <img
			src="images/banner/img8.jpg" alt="image8" /> <img
			src="images/banner/img9.jpg" alt="image9" />
	</div>
</body>
</html>