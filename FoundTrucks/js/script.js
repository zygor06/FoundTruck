
$(document).ready(function(){
		
	
	//Cria variável aleatória entre 1 e 12
	var random = Math.floor(Math.random() * 12) + 1;
	
	function carregarBanner(indice){
		$("#banner").css('background-image', 'url("images/banner/img' + indice + '.jpg")')
					.css('transition', '2s');
	}

	var duracao = 10000;
	!
	carregarBanner(random);

	function recursiva(){
		setTimeout(function() {
	        var nRandom = Math.floor(Math.random() * 12) + 1;
	        carregarBanner(nRandom);
	        recursiva();
		}, duracao);
	}

	recursiva();
	
});