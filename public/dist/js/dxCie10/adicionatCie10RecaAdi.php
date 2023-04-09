<?php

require_once("../consulta/conexion.php");
$conn = new DBController();
$dx = $_GET['dx'];
$idSiniestro = $_GET['idSiniestro'];
$descripcionDiagnostico = $_GET['descripcionDiagnostico'];

$sql = "INSERT INTO `tbl_cie_10_adicionados` (`llave_cie10_union`, `descripcion` , `llaveAdicionPcl`, `moduloDeDx`) VALUES ('$dx','$descripcionDiagnostico','$idSiniestro', 'RECALIFICACION');";
$resultset = mysqli_query($conexion1, $sql) or die("database error:" . mysqli_error($conn));

