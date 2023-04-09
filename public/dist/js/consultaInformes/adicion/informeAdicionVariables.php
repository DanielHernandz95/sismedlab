<?php
session_start();

$_SESSION['canalEntradaAdi'] = $_GET['canalEntradaAdi'];
$_SESSION['quienSolicitaAdi'] = $_GET['quienSolicitaAdi'];
$_SESSION['tipoSolicitudAdi'] = $_GET['tipoSolicitudAdi'];
$_SESSION['estadoAdi'] = $_GET['estadoAdi'];
$_SESSION['subEstadoAdi'] = $_GET['subEstadoAdi'];
$_SESSION['asigandoAdi'] = $_GET['asigandoAdi'];
$_SESSION['fechaDesdeAdi'] = $_GET['fechaDesdeAdi'];
$_SESSION['fechaHastaAdi'] = $_GET['fechaHastaAdi'];
?>

