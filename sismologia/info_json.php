<?php
if(isset($_GET['mac'])){
	$mac = $_GET['mac'];
	?><input type="hidden" value="<?php echo $mac;?>" id="mac" /><?php
}else{
	?><input type="hidden" value="" id="mac" /><?php
}
if(isset($_GET['fecha'])){
	$fecha = $_GET['fecha'];
	?><input type="hidden" value="<?php echo $fecha;?>" id="fecha" /><?php
}else{
	?><input type="hidden" value="" id="fecha" /><?php
}
if(isset($_GET['hora'])){
	$hora = $_GET['hora'];
	?><input type="hidden" value="<?php echo $hora;?>" id="hora" /><?php
}else{
	?><input type="hidden" value="" id="hora" /><?php
}
if(isset($_GET['latitud'])){
	$latitud = $_GET['latitud'];
	?><input type="hidden" value="<?php echo $latitud;?>" id="latitud" /><?php
}else{
	?><input type="hidden" value="" id="latitud" /><?php
}
if(isset($_GET['longitud'])){
	$longitud = $_GET['longitud'];
	?><input type="hidden" value="<?php echo $longitud;?>" id="longitud" /><?php
}else{
	?><input type="hidden" value="" id="longitud" /><?php
}
if(isset($_GET['status'])){
	$status = $_GET['status'];
	?><input type="hidden" value="<?php echo $status;?>" id="status" /><?php
}else{
	?><input type="hidden" value="" id="status" /><?php
}
if(isset($_GET['magnitud'])){
	$magnitud = $_GET['magnitud'];
	?><input type="hidden" value="<?php echo $magnitud;?>" id="magnitud" /><?php
}else{
	?><input type="hidden" value="" id="magnitud" /><?php
}
?>
<script>
var myVar = setInterval(actualizar, 300);
function actualizar() {
		
	 $.ajax({
		 //type: "json",
		 url: "actualizar_json.php",
		 //data: "mac="+mac+"&fecha="+fecha+"&hora="+hora+"&latitud="+latitud+"&longitud="+longitud+"&status"+status+"&magnitud="+magnitud,
		 //cache: false,
		 success: function(data){
			 document.body.innerHTML = data;
		 }
	 });
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script>