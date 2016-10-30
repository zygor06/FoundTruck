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
		
		<style>#map-container { height: 450px }</style>

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
				<p>Localize o FoodTruck de sua preferência mais próximo em apenas um clique.</p>
				<ul class="actions">
					<li>
						<!-- <a href="#" class="button big">Rastreio Rápido</a> -->
						<!--<a href="#" class="button big" data-toggle="modal" data-target="#mapaModal">Rastreio Rápido</a>-->
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
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim quam consectetur quibusdam magni minus aut modi aliquid.</p>
							</section>
						</div>
						<div class="4u 12u$(medium)">
							<section class="box">
								<i class="icon big rounded color9 icon-food"></i>
								<h3>Comida pra todo gosto</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium ullam consequatur repellat debitis maxime.</p>
							</section>
						</div>
						<div class="4u$ 12u$(medium)">
							<section class="box">
								<i class="icon big rounded color6 icon-truck"></i>
								<h3>Diversos parceiros</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eaque eveniet, nesciunt molestias. Ipsam, voluptate vero.</p>
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
				<script>
					$(function () {
						function initMap() {
							var foodtrucks = JSON.parse( '<?php echo json_encode($foodtrucks) ?>' );							
							var centro = new google.maps.LatLng(-15.793750, -47.882862);		        
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
								<h3>Lorem ipsum dolor</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Nesciunt itaque, alias possimus</a></li>
									<li><a href="#">Optio rerum beatae autem</a></li>
									<li><a href="#">Nostrum nemo dolorum facilis</a></li>
									<li><a href="#">Quo fugit dolor totam</a></li>
								</ul>
							</section>
							<section class="3u 6u$(medium) 12u$(small)">
								<h3>Culpa quia, nesciunt</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Reiciendis dicta laboriosam enim</a></li>
									<li><a href="#">Corporis, non aut rerum</a></li>
									<li><a href="#">Laboriosam nulla voluptas, harum</a></li>
									<li><a href="#">Facere eligendi, inventore dolor</a></li>
								</ul>
							</section>
							<section class="3u 6u(medium) 12u$(small)">
								<h3>Neque, dolore, facere</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Distinctio, inventore quidem nesciunt</a></li>
									<li><a href="#">Explicabo inventore itaque autem</a></li>
									<li><a href="#">Aperiam harum, sint quibusdam</a></li>
									<li><a href="#">Labore excepturi assumenda</a></li>
								</ul>
							</section>
							<section class="3u$ 6u$(medium) 12u$(small)">
								<h3>Illum, tempori, saepe</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Recusandae, culpa necessita nam</a></li>
									<li><a href="#">Cupiditate, debitis adipisci blandi</a></li>
									<li><a href="#">Tempore nam, enim quia</a></li>
									<li><a href="#">Explicabo molestiae dolor labore</a></li>
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
		
		<!-- Modal -->
			<div class="modal fade" id="mapmodals">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><center>Found Trucks</center></h4>
						</div>
						<div class="modal-body">
							<div id="map-container"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="close" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
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
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyAmrExWndfKz7CdR7vZADNbCbKj7GgX4So&callback=initMap"></script>
		<!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmrExWndfKz7CdR7vZADNbCbKj7GgX4So&callback=initMap" async defer></script>-->		
		<script src="js/googleMaps.js"></script>

	</body>
</html>