<?php
$archivo = fopen("status.txt","w") or die("Problemas al escribir");
$grabacion = $_POST['status'];
fwrite($archivo,$grabacion);
fclose($archivo);
echo "Status enviado";
 ?>