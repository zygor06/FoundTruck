

$(document).ready(function(){
	
	//Cria variável aleatória entre 1 e 12
	var random = Math.floor(Math.random() * 12) + 1;
	
	function carregarBanner(indice){
		$("#banner").css('background-image', 'url("images/banner/img' + indice + '.png")');
	}
	
	carregarBanner(random);
	console.log('Hello');
});