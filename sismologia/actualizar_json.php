<?php
$contador = 0;

$arreglo_mac = array();
$arreglo_latitud = array();
$arreglo_longitud = array();
$arreglo_fecha = array();
$arreglo_hora = array();
$arreglo_magnitud = array();

$arreglo_hora_h = array();
$arreglo_hora_m = array();
$arreglo_hora_s = array();

$entro=true;

$cont = 0;

$lineas = array();
$contador_lineas = 0;

$archivo = fopen('info.txt','r');
while ($linea = fgets($archivo)) {
	if($linea!=null){
		
		$columnas = explode("@",$linea);
		
		$arreglo_mac[$contador] = $columnas[1];
		$arreglo_latitud[$contador] = $columnas[2];
		$arreglo_longitud[$contador] = $columnas[3];
		$arreglo_fecha[$contador] = $columnas[4];
		$arreglo_hora[$contador] = $columnas[5];
		$arreglo_magnitud[$contador] = $columnas[6];
		
		$columnas_horas = explode(":",$arreglo_hora[$contador]);
		
		$arreglo_hora_h[$contador] = $columnas_horas[0];
		$arreglo_hora_m[$contador] = $columnas_horas[1];
		$arreglo_hora_s[$contador] = $columnas_horas[2];
		
		$contador++;
	}
}

for($i=0; $i<count($arreglo_mac); $i++){
	if($i==$cont){
		$cambio_mac = $arreglo_mac[$i];
		$cambio_latitud = $arreglo_latitud[$i];
		$cambio_longitud = $arreglo_longitud[$i];
		$cambio_fecha = $arreglo_fecha[$i];
		$cambio_hora_junto = $arreglo_hora[$i];
		$cambio_hora = $arreglo_hora_h[$i];
		$cambio_minuto = $arreglo_hora_m[$i];
		$cambio_segundo = $arreglo_hora_s[$i];
		$cambio_magnitud = $arreglo_magnitud[$i];
		$entro=true;
		
	}else{
		if($cambio_mac == $arreglo_mac[$i] & $cambio_hora == $arreglo_hora_h[$i] & ($cambio_minuto == $arreglo_hora_m[$i] || $cambio_minuto+1 == $arreglo_hora_m[$i] || $cambio_minuto+2 == $arreglo_hora_m[$i])){
			if($cambio_magnitud<$arreglo_magnitud[$i]){
				$cambio_magnitud = $arreglo_magnitud[$i];
			}
			if($i==(count($arreglo_mac)-1)){	
				//echo "*mac=" . $arreglo_mac[$i] . " **inicio=" . $cambio_hora . ":" . $cambio_minuto . ":" . $cambio_segundo . " **termino=" . $arreglo_hora[$i] . " **magnitud=" . $cambio_magnitud . "\n";
				$lineas[$contador_lineas] =$arreglo_mac[$i] . "@" . $cambio_fecha . "@" . $cambio_hora . ":" . $cambio_minuto . ":" . $cambio_segundo . "@" . $arreglo_hora[$i] . "@" . $cambio_latitud . "@" . $cambio_longitud . "@" . $cambio_magnitud;
				$contador_lineas++;
			}
		}else{			
			if($entro){
				//echo "*mac=" . $arreglo_mac[$i-1] . " **inicio=" . $cambio_hora . ":" . $cambio_minuto . ":" . $cambio_segundo . " **termino=" . $arreglo_hora[$i-1] . " **magnitud=" . $cambio_magnitud . "\n";
				$lineas[$contador_lineas] =$arreglo_mac[$i-1] . "@" . $cambio_fecha . "@" . $cambio_hora . ":" . $cambio_minuto . ":" . $cambio_segundo . "@" . $arreglo_hora[$i-1] . "@" . $cambio_latitud . "@" . $cambio_longitud . "@" . $cambio_magnitud;
				$contador_lineas++;
				$entro=false;
				$cont = ($i);
				$i = $i-1;
			}
		}
	}
}
fclose($archivo);
//Impresion en text
for($j=0; $j<count($lineas); $j++){
	//echo $lineas[$j];
}
//Impresion en Json
$array_json = array();
foreach ($lineas as $d) {
	$col = explode("@",$d);
    $array_json[] = array(
		'mac' => $col[0], 
		'fecha' => $col[1],
		'hora_inicio' => $col[2],
		'hora_fin' => $col[3],
		'latitud' => (float)$col[4],
		'longitud' => (float)$col[5],
		'magnitud' => (float) $col[6],
	);
}
echo json_encode($array_json);
?>
