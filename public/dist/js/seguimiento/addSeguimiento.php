<?php

// Conexion a la base de datos
include '../consulta/conexion.php';

if (!empty($_GET['TxtRevisadoPor'])) {

    $subEstado = $_GET['TxtSubEstado'];
    $fechaContacto = $_GET['TxtFechaContactoAfiliado'];
    $seguimiento = $_GET['TxtSeguimiento'];
    $idSiniestroPcl = $_GET['TxtSiniestroPclSe'];
    $revisadoPor = $_GET['TxtRevisadoPor'];
    $tipoSeguimiento = $_GET['TxtTipoSeguimiento'];

    if ($tipoSeguimiento = 0) {
        $tseguimieto = 'primer';
    } else if ($tipoSeguimiento = 1) {
        $tseguimieto = 'segundo';
    } else if ($tipoSeguimiento = 2) {
        $tseguimieto = 'tercer';
    } else {
        $tseguimieto = 'tercer';
    }

    $sql = "INSERT INTO `tbl_seguimientos` (`tipoSeguimiento`,  `seguimiento`, `llaveSubEstado`, `llaveRevisadoPor`, `llaveSiniestroPcl`) values ('$tseguimieto', '$seguimiento', '$subEstado', '$revisadoPor', '$idSiniestroPcl')";


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
