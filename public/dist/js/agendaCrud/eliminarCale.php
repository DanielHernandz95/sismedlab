<?php

// Conexion a la base de datos
include '../consulta/conexion.php';

if (!empty($_GET['TxtCalendario'])) {

    $idCalendario = $_GET['TxtCalendario'];
    $sql = "DELETE FROM `tbl_calendarios` WHERE (`idcalendario` = '$idCalendario');";


    $query = $conexion1->prepare($sql);
    if ($query == false) {
        print_r($conexion1->errorInfo());
        die('Erreur prepare');
    }
    $sth = $query->execute();
    if ($sth == false) {
        print_r($query->errorInfo());
        die('Erreur execute');
    }
}
//header('Location: '.$_SERVER['HTTP_REFERER']);
?>
