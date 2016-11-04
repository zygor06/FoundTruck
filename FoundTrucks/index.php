<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Found Truck</title>

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
			<header id="header">				
				<h1 id="logo"><a href="/" id="logo-name">FoundTruck</a></h1>
				
				<nav id="nav">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="parceiros.html">Parceiros</a></li>
						<li><a href="sobre.html">Sobre</a></li>
						<li><a href="#" class="button special">Logar</a></li>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h2>Olá. Este é o Found Truck.</h2>
				<p>Localize seu FoodTruck preferido em apenas um clique.</p>
				<ul class="actions">
					<li>				
						<a href="#two" class="button big">Rastreio Rápido</a>	
					</li>
				</ul>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1 special">									
				<div class="container">	

					<header class="major">
						<h2>Sua fome não pode esperar</h2>
						<p>Encontre o <strong>FoodTruck</strong> mais próximo de você já!</p>
					</header>
					<div class="row 150%">
						<div class="4u 12u$(medium)">
							<section class="box">
								<i class="icon big rounded color1 icon-map-marker"></i>
								<h3>Localização em tempo real</h3>
								<p>Veja onde se encontra seu foodtruck favorito ou qual é o mais próximo de você.</p>
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
								<p>Com nosso site, você poderá desfrutar de vários tipos de comida.</p>
							</section>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<?php
			include "classes/DaoFoodtruck.php";
			$foodtrucks = DaoFoodtruck::getInstance ()->retornarLatLong();	
			?>
			<!-- <section id="two" class="wrapper style2 special">				 -->
			<section id="two">				
				<div id="map"></div>				
			
				<link href='css/mapa.css' rel='stylesheet' type='text/css'>
				<p id="geo"></p>
				<script>

					$(function () {
					
						function getLocation() {
							if (navigator.geolocation) {
								navigator.geolocation.getCurrentPosition(initMap);
							} else {
								x.innerHTML = "Geolocation is not supported by this browser.";
							}
						}

						getLocation();
					
						function initMap(position) {							
								
							var foodtrucks = JSON.parse( '<?php echo json_encode($foodtrucks) ?>' );																					
							<!-- CORRIGIR CASO O USUÁRIO NÃO FORNEÇA PERMISSÃO PARA GEOLOCALIZAÇÃO! -->
							var centro = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);							
														
							var mapCanvas = document.getElementById('map');
							var mapOptions = {
								center: centro,
								zoom: 13,
								panControl: false,
								scrollwheel: false,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							}
							var map = new google.maps.Map(mapCanvas, mapOptions);
							var markerImage = 'images/marcador.png';
							<!-- var styles = [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}]; -->
							/* map.set('styles', styles); */
							
							<!-- Inserção dos marcadores -->
							for (i = 0; i < foodtrucks.length; i++) { 							
								var lat = foodtrucks[i]['NR_LAT'];
								var lng = foodtrucks[i]['NR_LONG'];		
								var nome = foodtrucks[i]['TE_NOME'];
								var alimento = foodtrucks[i]['TE_ALIMENTO'];
								var descricao = foodtrucks[i]['TE_DESCRICAO'];								
								var marcador = new google.maps.LatLng(lat, lng);
								var contentString = '<div class="info-window">' +
										'<h3>'+ nome + '</h3>' +
										'<h4>'+ alimento + '</h4>' +
										'<div class="info-content">' +
										'<p>'+ descricao + '</p>' +
										'</div>' +
										'</div>';	
								var marker = new google.maps.Marker({
									position: marcador,
									map: map,
									icon: markerImage,
									title: nome + ': ' + alimento
								});
							
								var infowindow = new google.maps.InfoWindow()
								
								google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){ 
									return function() {
									infowindow.setContent(contentString);
									infowindow.open(map,marker);
									};
								})(marker,contentString,infowindow));
								
							}
						}
						google.maps.event.addDomListener(window, 'load', initMap);
					});					
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmrExWndfKz7CdR7vZADNbCbKj7GgX4So"></script>				
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<section class="links">
						<div class="row">
							<section class="3u 6u(medium) 12u$(small)">
								<h3>Found Truck</h3>
								<ul class="unstyled">
									<li><a href="/">Página principal</a></li>
									<li><a href="/">Rastreio rápido</a></li>							
								</ul>
							</section>
							<section class="3u 6u$(medium) 12u$(small)">
								<h3>Procure parceiros</h3>
								<ul class="unstyled">
									<li><a href="parceiros.html">Pesquisar</a></li>
									<li><a href="parceiros.html">Filtrar</a></li>
									<li><a href="parceiros.html">Listar</a></li>
									
								</ul>
							</section>
							<section class="3u 6u(medium) 12u$(small)">
								<h3>Seja um parceiro</h3>
								<ul class="unstyled">
									<li><a href="CadastroFoodtruck.html">Cadastre-se</a></li>
									<li><a href="/">Entre</a></li>
									
								</ul>
							</section>
							<section class="3u$ 6u$(medium) 12u$(small)">
								<h3>Sobre a equipe</h3>
								<ul class="unstyled">
									<li><a href="ContatoSobre.html">Sobre a equipe Foundtruck</a></li>
									<li><a href="ContatoSobre.html">Contate-nos</a></li>
									
								</ul>
							</section>
						</div>
					</section>
					<div class="row">
						<div class="8u 12u$(medium)">
							<ul class="copyright">
								<li>&copy; FoundTruck. Todos os Direitos Reservados</li>
								<li>Desenvolvimento: <a href="http://www.uniceub.br" title="Turma de Ciência da Computação - 5º Período">TCC - UniCEUB</a></li>
								<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
							</ul>
						</div>
						<div class="4u$ 12u$(medium)">
							<ul class="icons">
								<li>
									<a class="icon rounded icon-facebook"><span class="label">Facebook</span></a>
								</li>
								<li>
									<a class="icon rounded icon-twitter"><span class="label">Twitter</span></a>
								</li>
								<li>
									<a class="icon rounded icon-google-plus"><span class="label">Google+</span></a>
								</li>
								<li>
									<a class="icon rounded icon-linkedin"><span class="label">LinkedIn</span></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
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