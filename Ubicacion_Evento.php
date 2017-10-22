<?php
	
	$Latitud = $_GET['Lat'];
	$Longitud = $_GET['Long'];

	$Script_Map = "<script>
				      function initMap() {
				      	var uluru0 = {lat: ". $Latitud .", lng: " . $Longitud . "};					        
					        					    				       
						var map = new google.maps.Map(document.getElementById('map'), {
					          zoom: 4,
					          center: uluru0
					    });
					    var marker0 = new google.maps.Marker({
					          position: uluru0,
					          map: map,
					          title: ''
					    });				    
					  }
				    </script>;";

	echo $Script_Map;

?>