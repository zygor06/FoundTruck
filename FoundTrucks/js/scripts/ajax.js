/*!
 * jFVida object
 */

function erroAconteceu(objeto){	
	
	if (objeto.boSessaoExpirou){
		window.location="http://www.fipecqvida.org.br";
	}
	
	if (objeto.boErroAconteceu){
		return true;
	}else{
		return false;
	}
}

function sucessoAconteceu(objeto){
	if (objeto.boSucessoAconteceu){
		return true;
	}else{
		return false;
	}
}

function alertaAconteceu(objeto){
	if (objeto.boErroAconteceu){
		return true;
	}else{
		return false;
	}
}

(function(window){
    var $jfv,

    // the constructor
    jFVida = $jfv = function(){
        
    };
    
    //
    $jfv.windowLoaded = false;
    
    $jfv.fn = jFVida.prototype = {};
    
    $jfv.fn.ajax = function(oConf,fCallback)
    {
    	
        var sPrefix  = '',
        oDefaultConf = {},
        i,
        oForm,
        sSer;
        oDefaultConf = {
            dataType    : 'json',
            type        : 'POST',
            url         : "index.php",
            //url         : "/includes/php/Ajax.php",
            //url         : "http://www.fipecqvida.org.br/includes/php/Ajax.php",
            
            fCallback   : null,
            data        : null,            
            success   : function (oResponse, sTextStatus, oXHR) {            	
                $jfv.fn.ajaxSuccess(oResponse, oDefaultConf, oXHR);
            },
            error    : function (oXHR, sTextStatus, oE) {
                $jfv.fn.ajaxError(oXHR, sTextStatus, oE, oDefaultConf);
            }
        };
        
        for (i in oConf) {
        	oDefaultConf[i] = oConf[i];
        }
        
        if (oDefaultConf.data.constructor.name == 'FormData'){
        	oDefaultConf.processData = false;
        	oDefaultConf.contentType = false;
        	oDefaultConf.fCallback = eval(fCallback);
        }
        
        oDefaultConf.url = oDefaultConf.url + '?_r=' + new Date().getTime();
        
        
        if (oDefaultConf.fCallback === null) {
        	var nmMetodo = oDefaultConf.data.nmMetodo
        	
        	oDefaultConf.fCallback = eval(nmMetodo + 'Retorno');
		      
		    if (!oDefaultConf.fCallback) {
		    	oDefaultConf.fCallback = null;
		    }
		}
               
       //console.log(oDefaultConf);
        $.ajax(oDefaultConf);
    };
    
    $jfv.fn.ajaxSuccess = function (oResponse, oConf, oXHR)
    {
    	
        if (null !== oConf.fCallback) {
            oConf.fCallback(oResponse, oConf, oXHR);
        }
        
        if (oResponse['__JGF_DEBUG__']) {
            
            // json-handle plugin not working when simple openning a new window
            // and writting json. So i needed to sumit a form to one page and
            // echo the submited data via json. it might be a json-handle bug but
            // anyway... now its working
            var oWin = window.open();
            oWin.document.write(
                '<form name="f" action="/__JGF_DEBUG__" method="post">' +
                '<input type="hidden" name="d" value="' + oResponse.sText  + '">' +
                '</form><script>document.f.submit();</script>'
            );

            oWin.document.close();
        }
    };
    
    $jfv.fn.ajaxError = function (oXHR, sTextStatus, oE, oDefaultConf) 
    {
    	
        if (oXHR.responseText) {
            var oWin = window.open('', '_blank', '');
            oWin.document.write(oXHR.responseText);
        } else {

	        console.log(oXHR,sTextStatus,oE,oDefaultConf);	        
	        /*console.log(sTextStatus);
	        console.log(oE);
	        console.log(oDefaultConf);*/
           // $jfv.fn.hasError(null, true);
        }
    };
    
    $jfv.fn.hasError = function (oParam, bAlert)
    {
    	var aError,
    	sI;
    	
        if ((oParam && (oParam.aError || !oParam.bSuccess)) || !oParam) {
            if (bAlert) {
                aError = [];

                try {
                    aError = oParam.aError;
                } catch (oE) {
                	console.log(oE);
                }
            
                if (!aError) {
                    aError = ['Unexpected error. Try again!'];
                }
                
                sI = null;
                for (sI in aError) {
                	$("#container-alert-danger ul").append('<li>' + aError[sI] + '</li>\n');
                	
                	if (!/\d+/.test(sI)) {
                		if ($("#fg-" + sI).attr('id')) {
                			$("#fg-" + sI).addClass('has-error has-feedback');
                		}
                		
                		console.log(sI);
                		//has-error has-feedback
                	}
                }
                
                if (null !== sI) {
                	window.scrollTo(0, 0);
                	$("#container-alert-danger").slideDown();
                }
                
                /*
                var oModal = $jfv.fn.modalAlert('error', 'Error', aError.split('<br>'), function() {
                    if (fOnClose) {
                        fOnClose.call();
                    }
                });
                
                oModal.modal('show');
                */
                
                
            }
            return true;
        } else {
            return false;
        }
    };
    
    // ajax get shortcut
    $jfv.fn.get = function(oConf)
    {
        oConf.type = 'GET';
        $jfv.fn.ajax(oConf);
    };
    
    // ajax post shortcut
    $jfv.fn.post = function(oConf,fCallback)
    {
        oConf.type = 'POST';
        $jfv.fn.ajax(oConf,fCallback);
    };
    
    
//    $jfv.fn.modalAlert = function(sId, sTitle, sBody, fOnClose)
//    {
//        var oModalClone;
//        
//        if ($("#modal-alert-" + sId).attr('id')) {
//            oModalClone = $("#modal-alert-" + sId); 
//        } else {
//            oModalClone = $("#modal-alert").clone();
//            oModalClone.attr('id', 'modal-alert-' + sId);
//            $('body').append(oModalClone);
//        }
//        
//        if (fOnClose) {
//            oModalClone.unbind('hidden.bs.modal');
//            oModalClone.on('hidden.bs.modal', fOnClose);    
//        }
//        
//        $("#modal-alert-" + sId + " .modal-title").html(sTitle);
//        $("#modal-alert-" + sId + " .modal-body").html(sBody);
//        
//        return oModalClone;
//    };
    
    $jfv.fn.isEmailValid = function(sEmail)
    {
        var oRe = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return oRe.test(sEmail);    
    };
    
    $jfv.fn.redirect = function(sLocation, bAppendLocale, bAppendPrefix) 
    {
        if (false !== bAppendLocale) {
            sLocation = oRoute.sLocale + '/' + sLocation;
        }
        
        if (false !==  bAppendPrefix) {
            sLocation = oRoute.sPrefix + '/' + sLocation;
        }
        sLocation = ('/' + sLocation).replace('//', '/');
        sLocation = sLocation.replace('//', '/');
        document.location = sLocation;
    };
    
    $jfv.fn.cleanContainerAlert = function()
    {
    	$(".container-alert").hide();
    	$(".container-alert li").remove();
    };
    
    $jfv.fn.cleanFormGroupFeedback = function()
    {
    	$(".form-group").removeClass('has-error has-feedback');
    };
    
    $jfv.fn.getHashParams = function(hash)
    {
    	
    };
    
    window.jFVida = window.$jfv = new jFVida();
})(window);