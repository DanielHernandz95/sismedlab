<?php
session_start();

$_SESSION['canalEntradaCa'] = $_GET['canalEntradaCa'];
$_SESSION['quienSolicitaCa'] = $_GET['quienSolicitaCa'];
$_SESSION['tipoSolicitudCa'] = $_GET['tipoSolicitudCa'];
$_SESSION['estadoCa'] = $_GET['estadoCa'];
$_SESSION['subEstadoCa'] = $_GET['subEstadoCa'];
$_SESSION['asigandoCa'] = $_GET['asigandoCa'];
$_SESSION['fechaDesdeCa'] = $_GET['fechaDesdeCa'];
$_SESSION['fechaHastaCa'] = $_GET['fechaHastaCa'];
?>

