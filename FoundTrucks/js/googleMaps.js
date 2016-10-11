var var_map;
var var_location = new google.maps.LatLng(-15.7906688,-47.8942683);

function map_init() {	

	var var_mapoptions = {
		center: var_location,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		panControl:false,
		rotateControl:false,
		streetViewControl: false,
	};
	var_map = new google.maps.Map(document.getElementById("map-container"),
	var_mapoptions);

	var contentString = 
	'colocar'+
	' aqui '+
	' informações ' +
	' do food truck '+
	' da base de dados. ';				

	var var_infowindow = new google.maps.InfoWindow({
		content: contentString
	});

	var var_marker = new google.maps.Marker({
		position: var_location,
		map: var_map,
		title:"Clique para informações sobre o Food Truck",
		maxWidth: 200,
		maxHeight: 200
	});

	google.maps.event.addListener(var_marker, 'click', function() {
		var_infowindow.open(var_map,var_marker);
	});
}

google.maps.event.addDomListener(window, 'load', map_init);

//start of modal google map
$('#mapmodals').on('shown.bs.modal', function () {
	google.maps.event.trigger(var_map, "resize");
	var_map.setCenter(var_location);
});