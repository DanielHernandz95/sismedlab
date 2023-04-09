<?php

require_once("conexion.php");
$conn = new DBController();
$id = $_POST['id'];

$sql = "DELETE FROM tbl_cie_10_adicionados WHERE id_cie10_adicionados='$id'";
$resultset = mysqli_query($conexion1, $sql) or die("database error:" . mysqli_error($conn));

