<?php

	session_start();
	$ID_Usuario = $_POST['usr'];
	$N_Usuario = $_POST['unm'];
	$M_Usuario = $_POST['ueml'];
	$Tipo_Login = $_POST['tipo'];

	$_SESSION['ID_Usr'] = $ID_Usuario;
	$_SESSION['N_Usr'] = $N_Usuario;
	$_SESSION['Tipo_Lg'] = $Tipo_Login;

	if($Tipo_Login == "fb"){
		$url = "https://graph.facebook.com/" . $ID_Usuario . "/picture";
	}
	else if($Tipo_Login == "gl"){
		$url = $_POST['urimg'];	
	}


	echo "Nombre: " . $_SESSION['N_Usr'] . " - ID User: " . $_SESSION['ID_Usr'] . " - Email: " . $M_Usuario = $_POST['ueml'];
	echo "<br/>";
	echo "<img src='" . $url . "'>";
?>