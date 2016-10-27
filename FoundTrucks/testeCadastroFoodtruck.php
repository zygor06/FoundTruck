<html>
<head>
<meta>
<title>Cadastro de Usuário</title>
<style>
label {
	display: inline-block;
	width: 100px;
	text-align: right;
}
</style>
<script>
var lat = document.getElementById("lat");
var longt = document.getElementById("long")
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(returnPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function returnPosition(position){
	lat.value = position.coords.latitude;
	longt.value = position.coords.longitude;
}

function returnLong(position){
	 longt.value = position.coords.longitude;
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}
</script>
</head>
<body>
	<form name="formCadastro" method="post"
		action="classes/autenticacao/AutenticacaoCadastroFoodtruck.php">
		<fieldset>
			<legend>Cadastro de Foodtruck</legend>

			<label>CPF do usuario: </label><input type="text" name="nrCpf" /><br />
			<label>Nome:</label><input type="text" name="teNome" /><br />
			<label>Latitude: </label><input type="text" name="teLat" id="lat" /><br />
			<label>Longitude: </label><input type="text" name="teLong" id="long" /><br />
			<label>Descricao: </label><input type="text" name="teDescricao" /><br />
			<label>Imagem: </label><input type="text" name="teImagem" /><br />
			<input type="submit"
				value="confirmar" />
				
				<!-- TE_NOME, NR_LAT, NR_LONG, NR_CPF_USUARIO, TE_DESCRICAO,	TE_IMAGEM, CS_ATIVO -->
				
		</fieldset>

	</form>
</body>
</html>