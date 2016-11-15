<header id="header">
		<h1 id="logo">
			<a href="/" id="logo-name">FoundTruck</a>
		</h1>

		<nav id="nav">
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/parceiros.php">Parceiros</a></li>
				<li><a href="/sobre.php">Sobre</a></li>				
			</ul>
		</nav>		
		
		<div class="modal fade" id="cadastro-modal" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true"
			style="display: none;">
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<h2 class="text-center" style="color:black !important;padding: 17px 0px;">Informe seus dados</h2>
					<form method="post" action="classes/autenticacao/AutenticacaoUsuario.php">
						<input type="text" name="user" placeholder="CPF"> 
						<input type="text" name="user" placeholder="CPF"> 
						<input type="text" name="user" placeholder="CPF"> 
						<input type="password" name="pass" placeholder="Senha">
						<input type="submit" name="login" class="login loginmodal-submit" value="Login">
					</form>
				</div>
			</div>
		</div>

	</header>