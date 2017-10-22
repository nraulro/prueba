<?php
$archivo = fopen("info.txt","a") or die("Problemas al escribir");
$grabacion = $_POST['grabacion'];
fwrite($archivo,$grabacion);
fclose($archivo);
echo "Info enviada";
 ?>