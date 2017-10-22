<?php
	
	date_default_timezone_set('UTC');
	setlocale(LC_ALL,"es_ES");
	$diferencia = 10;

	$DatetimeFechaActual = new DateTime("now");
		// Restamos dias a la fecha actual
	$DatetimeFechaActual->sub(new DateInterval('P' . $diferencia . 'D'));
	$nuevafecha = $DatetimeFechaActual->format('Y-m-d');

 
	echo "Fecha Inicial: " . $nuevafecha . "</br>";

		//$json = file_get_contents('https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=2017-09-25');
	$json = file_get_contents('https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime='.$nuevafecha.'&minlatitude=7&minlongitude=-99&maxlatitude=16&maxlongitude=-78');

	$obj = json_decode($json);

	echo "Sismos Registrados: " . $obj->metadata->count . "</br></br>";

	$total = $obj->metadata->count - 1;

	$Datos = "";

		$Tabla = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
					 <thead>
					  <tr>
					    <th>Lugar</th>
					    <th>Magnitud</th>
					    <th>Ubicacion</th>
					    <th>Fecha</th>
					    <th>Ver</th>				    
					  </tr>
					</thead>
					<tfoot>
					  <tr>
					    <th>Lugar</th>
					    <th>Magnitud</th>
					    <th>Ubicacion</th>
					    <th>Fecha</th>
					    <th>Ver</th>
					  </tr>
					</tfoot>
					<tbody>					  
				  	";

	$Script_Map = "<script>
				      function initMap() {";

	for ($i=0; $i <= $total; $i++) { 
		
		$Datos .=  "<tr><td>" . $obj->features[$i]->properties->place . "</td><td>" . $obj->features[$i]->properties->mag . "</td>";
		$Datos .=  "<td>" . $obj->features[$i]->geometry->coordinates[0] . "," . $obj->features[$i]->geometry->coordinates[1] . "</td><td>" . date('r', substr($obj->features[$i]->properties->time,0,10)) . "</td>";		

		$Latitud = $obj->features[$i]->geometry->coordinates[1];
		$Longitud = $obj->features[$i]->geometry->coordinates[0];

		$Datos .= "<td><a href='Mapa.php?Lat=" . $Latitud . "&Long=" . $Longitud . "'><i class='fa fa-area-chart'></i>Ver</a></td>";

		$Script_Map.= " var uluru".$i." = {lat: ". $Latitud .", lng: " . $Longitud . "};					        
					        
					        var marker".$i." = new google.maps.Marker({
					          position: uluru".$i.",
					          map: map,
					          title: '".$obj->features[$i]->properties->place."'
					        });					        
					      ";		
	}

	$Tabla_Fin = "</tbody>
				  </table>";

	$Script_Map .= "var map = new google.maps.Map(document.getElementById('map'), {
					          zoom: 4,
					          center: uluru0
					        });
					        ";

		for ($j=0; $j <= $total; $j++) { 
			$Script_Map.= "var marker".$j." = new google.maps.Marker({
					          position: uluru".$j.",
					          map: map,
					          title: '".$obj->features[$j]->properties->place."'
					        });					        
					      ";
		}

		$Script_Map .= "}
				    </script>";
	

	$Tabla_Completa = $Tabla . $Datos . $Tabla_Fin . $Script_Map;

	return $Tabla_Completa;

?>