<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Nome do Food Truck</title>

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
						<h2>Nome do Food Truck</h2>
						<p>Food truck que leva seu nome devido à ante aliquet commodo accumsan vis phasellus adipiscing</p>
					</header>

					<a href="#" class="image fit"><img src="images/foodtrucks/page/imgteste.jpg" alt="" /></a>

					<p>Vis accumsan feugiat adipiscing nisl amet adipiscing accumsan blandit accumsan sapien blandit ac amet faucibus aliquet placerat commodo. Interdum ante aliquet commodo accumsan vis phasellus adipiscing. Ornare a in lacinia. Vestibulum accumsan ac metus massa tempor. Accumsan in lacinia ornare massa amet. Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan.</p>
					<p>Amet nibh adipiscing adipiscing. Commodo ante vis placerat interdum massa massa primis. Tempus condimentum tempus non ac varius cubilia adipiscing placerat lorem turpis at. Aliquet lorem porttitor interdum. Amet lacus. Aliquam lobortis faucibus blandit ac phasellus. In amet magna non interdum volutpat porttitor metus a ante ac neque. Nisi turpis. Commodo col. Interdum adipiscing mollis ut aliquam id ante adipiscing commodo integer arcu amet Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan commodo odio cubilia ac eu interdum placerat placerat arcu commodo lobortis adipiscing semper ornare pellentesque.</p>
					<p>Amet nibh adipiscing adipiscing. Commodo ante vis placerat interdum massa massa primis. Tempus condimentum tempus non ac varius cubilia adipiscing placerat lorem turpis at. Aliquet lorem porttitor interdum. Amet lacus. Aliquam lobortis faucibus blandit ac phasellus. In amet magna non interdum volutpat porttitor metus a ante ac neque. Nisi turpis. Commodo col. Interdum adipiscing mollis ut aliquam id ante adipiscing commodo integer arcu amet blandit adipiscing arcu ante.</p>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="container">
					<header class="major">
						<h2>Lorem ipsum dolor sit</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, autem.</p>
					</header>
					<section class="profiles">
						<div class="row">
							<section class="3u 6u(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" alt="" />
								<h4>Lorem ipsum</h4>
								<p>Lorem ipsum dolor</p>
							</section>
							<section class="3u 6u$(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" alt="" />
								<h4>Voluptatem dolores</h4>
								<p>Ullam nihil repudi</p>
							</section>
							<section class="3u 6u(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" alt="" />
								<h4>Doloremque quo</h4>
								<p>Harum corrupti quia</p>
							</section>
							<section class="3u$ 6u$(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" alt="" />
								<h4>Voluptatem dicta</h4>
								<p>Et natus sapiente</p>
							</section>
						</div>
					</section>
				</div>
			</section>	

			<!-- Form -->
			<section id-"main" class="wrapper">
				<div class="container">
					<header class="major">
						<h3>Faça seu comentário</h3>
					</header>
					<form method="post" action="#">
						<div class="row uniform 50%">
							<div class="6u 12u$(4)">
								<input type="text" name="name" id="name" value="" placeholder="Seu nome" />
							</div>
							<div class="6u$ 12u$(4)">
								<input type="email" name="email" id="email" value="" placeholder="Seu e-mail" />
							</div>
							<div class="12u$">
								<textarea name="message" id="message" placeholder="Insira seu comentário" rows="6"></textarea>
							</div>
							<div class="12u$">
								<ul class="actions">
									<li><input type="submit" value="Enviar" class="special" /></li>
									<li><input type="reset" value="Limpar" /></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
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

	</body>
</html>