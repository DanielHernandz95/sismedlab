<?php

// Conexion a la base de datos
include '../consulta/conexion.php';

if (!empty($_GET['TxtCalendario'])){

	$tipoConsulta = $_GET['TxtTipoConsulta'];
	$hora = $_GET['TxtHora'];
	$idCalendario = $_GET['TxtCalendario'];
	$sql = "UPDATE `tbl_calendarios` SET `llaveHoraCita` = '$hora', `llaveTipoConsulta` = '$tipoConsulta' WHERE (`idcalendario` = '$idCalendario')";
	

  	
	$query = $conexion1->prepare( $sql );
	if ($query == false) {
	 print_r($conexion1->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
