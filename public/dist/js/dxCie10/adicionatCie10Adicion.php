<?php

//Archivo de conexi�n a la base de datos
include '../consulta/conexion.php';
//$conexion1 = conexion::getConexion();
//////////////////
//Obtenemos los datos del formData
$array_cie10 = $_POST['cie10'];
$array_Txtid = $_POST['Txtid'];
$array_TxtDescr = $_POST['TxtDescripAdicion'];
$array_Txtdig = $_POST['Txtdig'];
//Si falta alg�n dato, "matamos" el proceso
if (empty($array_cie10)) {
    ?>
    <span style="font-weight:bold; color:red; margin-left: 3%;">UNO O MÁS CAMPOS ESTÁN VACÍOS.</span>
    <?php

}

//Si todo est� correcto, procedemos a generar la consulta
//Generamos un array vac�o
//Obtenemos cada clave y su valor para poder contar la cantidad de datos e ingresarlos acorde a cada clave
foreach ($array_cie10 as $clave => $cie) {
    $datoUnico = array();
    $id = $array_Txtid[$clave];
    $diag = $array_TxtDescr[$clave];
    $origen = $array_Txtdig[$clave];
    $datoUnico[] = '("' . $cie . '", "' . $origen . '" , "' . $diag . '", "' . $id . '")';
    $query = $conexion1->query("INSERT INTO `tbl_cie_10_adicionados` (`llave_cie10_union`, `llave_tipo_cie10`, `descripcion`,`llaveAdicionPcl`) VALUES " . implode(',', $datoUnico));
}

//echo '<script>window.location="../../view/caso/gestion_siniestro.php?id_caso=' . $id . '"</script>';
?>