<?php

// Conexion a la base de datos
include '../consulta/conexion.php';

if (!empty($_GET['TxtDiaCita'])){

	$dia = $_GET['TxtDiaCita'];
	$medico = $_GET['Txtmedico'];
	$hora = $_GET['TxtHoraCita'];
        $idSiniestroPcl = $_GET['TxtSiniestroPcl'];
	$sql = "INSERT INTO tbl_calendarios(`llaveMedico`, `llaveSiniestroPclAgenda`, `diaCita`, `llaveHoraCita`) values ('$medico', '$idSiniestroPcl', '$dia', '$hora')";
	
	
  	
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
