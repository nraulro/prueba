<?php
	
	date_default_timezone_set('UTC');
	setlocale(LC_ALL,"es_ES");
	
	function calcular_tiempo_trasnc($hora1,$hora2)
	{
		//divido la hora en horas, min y seg porque viene en formato hh:mm:ss
		list( $h1, $m1, $s1 ) = explode( ":", $hora1 );
		list( $h2, $m2, $s2 ) = explode( ":", $hora2 );
		//resto los segundos
		$st=$s2-$s1;
		//si me da negativo resto el resultado a 60 y quito 1 a los minutos
		if($st<0){
		$st=60+$st;
		$m2=$m2-1;
		}
		//resto los minutos
		$mt=$m2-$m1;
		//si me da negativo resto el resultado a 60 y quito 1 a las horas
		if($mt<0){
		$mt=60+$mt;
		$h2=$h2-1;
		}
		//resto las horas
		$ht=$h2-$h1;
		//para que me de hh:mm:ss le agrego 0 alante del # si es menor que 10 sino me queda h:m:s para los menores que 10
		$c=0;
		if ($ht<10){
		$ht=$c.$ht;
		}
		if ($mt<10){
		$mt=$c.$mt;
		}
		if ($st<10){
		$st=$c.$st;
		}
		//devuelvo el tiempo transcurrido en formato hh:mm:ss
		return($ht.":".$mt.":".$st);
	} //aquí termina la función
	

	//$json = file_get_contents('https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=2017-09-25');
	$json = file_get_contents('http://buendiagt.com/acel/json.json');

	$obj = json_decode($json);	

	$total = sizeof($obj);
	echo "Sismos Registrados: " . $total . "</br></br>";

	$Datos = "";

		$Tabla = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
					 <thead>
					  <tr>
					    <th>MAC</th>
					    <th>Fecha</th>
					    <th>Hora Inicio/Hora Fin</th>
					    <th>Duración</th>
					    <th>Ubicación</th>
					    <th>Magnitud</th>
					    <th>Ver</th>
					  </tr>
					</thead>
					<tfoot>
					  <tr>
					    <th>MAC</th>
					    <th>Fecha</th>
					    <th>Hora Inicio/Hora Fin</th>
					    <th>Duración</th>
					    <th>Ubicación</th>
					    <th>Magnitud</th>
					    <th>Ver</th>
					  </tr>
					</tfoot>
					<tbody>					  
				  	";

	$Script_Map = "<script>
				      function initMap() {";

	for ($i=0; $i < $total; $i++) { 
		$Fecha = $obj[$i]->fecha;
		$Duracion = calcular_tiempo_trasnc($obj[$i]->hora_inicio,$obj[$i]->hora_fin);
		$Latitud = $obj[$i]->latitud;
		$Longitud = $obj[$i]->longitud;

		$Direccion = "https://maps.googleapis.com/maps/api/geocode/json?latlng=". $Latitud . "," . $Longitud . "&key=AIzaSyCfUTsX5x39EgWk5NmSGQY6lv-Cce481V0";

			try {

				$json_Ub = file_get_contents($Direccion);

				$obj_Ub = json_decode($json_Ub);

				$Nombre_Lugar = $obj_Ub->results[0]->formatted_address;
				
			} catch (Exception $e) {
				$Nombre_Lugar = "N/D";
			}			

			

		$Datos .=  "<tr>
					<td>" . $obj[$i]->mac . "</td>
					<td>" . $Fecha . "</td>";

		$Datos .=  "<td>" . $obj[$i]->hora_inicio . " / " . $obj[$i]->hora_fin . "</td>
					<td>" . $Duracion . "</td>
					<td>" . $Nombre_Lugar . " -- " . $Latitud . "," . $Longitud . "</td>" . 
				   "<td>" . $obj[$i]->magnitud . "</td>";				

		$Datos .= "<td><a href='Mapa.php?Lat=" . $Latitud . "&Long=" . $Longitud . "'><i class='fa fa-area-chart'></i>Ver</a></td>";

		$Script_Map.= " var uluru".$i." = {lat: ". $Latitud .", lng: " . $Longitud . "};					        
					        
					        var marker".$i." = new google.maps.Marker({
					          position: uluru".$i.",
					          map: map,
					          title: '".$obj[$i]->mac."'
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

		for ($j=0; $j < $total; $j++) { 
			$Script_Map.= "var marker".$j." = new google.maps.Marker({
					          position: uluru".$j.",
					          map: map,
					          title: '".$obj[$j]->mac."'
					        });					        
					      ";
		}

		$Script_Map .= "}
				    </script>";
	

	echo $Tabla . $Datos . $Tabla_Fin . $Script_Map;

?>