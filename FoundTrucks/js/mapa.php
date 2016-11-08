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