function exibeAlerta(mensagem, titulo,onClose){
	exibeModalMensagem('danger',mensagem,titulo,onClose);
}

function exibeAviso(mensagem, titulo,onClose){
	exibeModalMensagem('warning',mensagem,titulo,onClose);
}

function exibeInformacao(mensagem,titulo,onClose){
	
	exibeModalMensagem('info',mensagem,titulo,onClose);
}

function exibeSucesso(mensagem, titulo,onClose){
	//console.log(mensagem,titulo,onClose);
	exibeModalMensagem('success',mensagem,titulo,onClose)
}

function exibeMensagem(mensagem, titulo,onClose){
	
	exibeModalMensagem('primary',mensagem,titulo,onClose)
}

function exibeModalMensagem(tipo,mensagem,titulo,onClose){
	//console.log(1);
	//console.log(tipo,mensagem,titulo,onClose);
	// verifica se possui titulo definido
	if (titulo == null || titulo == ''){
		
		switch (tipo){
			case 'success':titulo = 'Sucesso!'; break;
			case 'info':titulo = 'Informação!'; break;
			case 'danger':titulo = 'Erro!'; break;
			case 'warning':titulo = 'Aviso!'; break;
			case 'primary':titulo = 'Mensagem'; break;
		}
	}

	// verfica o tipo para definir cor da borda
	switch (tipo){
		case 'success':	
			borderColor = '#dff0d8'; 
			classeIcone = 'glyphicon glyphicon-ok-sign text-sucess';
		break;
		case 'info':
			borderColor = '#31708f'; 
			classeIcone = 'glyphicon glyphicon-info-sign text-info';
		break;
		case 'danger':
			borderColor = '#a94442'; 
			classeIcone = 'glyphicon glyphicon-remove-circle text-danger ';
		break;
		case 'warning':
			borderColor = '#fcf8e3'; 
			classeIcone = 'glyphicon glyphicon-warning-sign text-warning ';
		break;
		case 'primary':
			borderColor = '#428bca';
			classeIcone = 'glyphicon glyphicon-info-sign';
		break;
		default: 
			borderColor = '#31708f'; 
			classeIcone = 'glyphicon glyphicon-info-sign';
			break;
	}		
	//console.log(2);
	/*
    (c) 2013 by DBJ.ORG, GPL/MIT applies

    expr argument is any legal jQuery selector.
    returns array of { element: , events: } objects
    events: is jQuery events structure attached (as  data)
    to the element:
    return is null if no events are found
 */
	
	// verifica se o modal já foi utilizado. Caso tenha sido remove classes já definidas
	
	if ($('#modalMensagemLabel').html() != ""){
		$('#modalMensagem .modal-body').removeClass($('#modalMensagem .modal-body').attr('class').split(' ').pop());
		$('#modalMensagemLabel').removeClass($('#modalMensagemLabel').attr('class').split(' ').pop());
		$('#textoMensagem').removeClass($('#textoMensagem').attr('class').split(' ').pop());
		$('#textoMensagem').removeClass($('#textoMensagem').attr('class').split(' ').pop());
		$('#btnMensagem').removeClass($('#btnMensagem').attr('class').split(' ').pop());
	}
	//console.log(3);
	// define classes e propriedades baseado no tipo 
	// as classes foram definidas previamente no twitter bootstrap
	
	$('#modalMensagemLabel').html(titulo);
	
	$('#textoMensagem').html(mensagem);
	
	if (tipo != null){
		$('#modalMensagem .modal-content').css('border-color', borderColor);
		$('#modalMensagem .modal-body').addClass('bg-'+tipo);
		$('#modalMensagemLabel').addClass('text-'+tipo);
		$('#textoMensagem').addClass('text-'+tipo);
		$('#textoMensagem').addClass('bg-'+tipo);
		$('#btnMensagem').addClass('btn-'+tipo);
		$('#iconeMensagem').attr('class',classeIcone);
	}else if(tipo == null){
		$('#modalMensagem .modal-content').css('border-color', borderColor);
		$('#modalMensagem .modal-body').addClass('bg-muted');
		$('#modalMensagemLabel').addClass('text-info');
		$('#textoMensagem').addClass('text-muted');
		$('#textoMensagem').addClass('bg-muted');		
		$('#iconeMensagem').attr('class',classeIcone);
		$('#btnMensagem').addClass('btn-primary');
	}
	//console.log(4);
	if (typeof onClose !== 'undefined' && onClose != ''){
		//console.log($._data($('#modalMensagem').get(0)),onClose);
		//console.log(typeof onClose == Function);
		if (typeof onClose === 'function'){
			$('#modalMensagem').on('hidden.bs.modal', onClose);
		}else{
			
			var fOnClose = new Function (onClose);
			$('#modalMensagem').on('hidden.bs.modal', fOnClose);
		}
		
	}
	
	// exibe o modal
	 console.log(onClose);
	$('#modalMensagem').modal();
	
	
}

jQuery.events = function (expr ) {
    var rez = [], evo ;
     jQuery(expr).each(
        function () {
           if ( evo = jQuery._data( this, "events"))
             rez.push({ element: this, events: evo }) ;
       });
   return rez.length > 0 ? rez : null ;
}


