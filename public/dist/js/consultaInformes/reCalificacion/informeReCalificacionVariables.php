<?php
session_start();

$_SESSION['canalEntradaRe'] = $_GET['canalEntradaRe'];
$_SESSION['quienSolicitaRe'] = $_GET['quienSolicitaRe'];
$_SESSION['tipoSolicitudRe'] = $_GET['tipoSolicitudRe'];
$_SESSION['estadoRe'] = $_GET['estadoRe'];
$_SESSION['subEstadoRe'] = $_GET['subEstadoRe'];
$_SESSION['asigandoRe'] = $_GET['asigandoRe'];
$_SESSION['fechaDesdeRe'] = $_GET['fechaDesdeRe'];
$_SESSION['fechaHastaRe'] = $_GET['fechaHastaRe'];
?>

