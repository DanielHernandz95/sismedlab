<?php
session_start();


$_SESSION['canalEntrada'] = $_GET['canalEntrada'];
$_SESSION['quienSolicita'] = $_GET['quienSolicita'];
$_SESSION['tipoSolicitud'] = $_GET['tipoSolicitud'];
$_SESSION['estado'] = $_GET['estado'];
$_SESSION['subEstado'] = $_GET['subEstado'];
$_SESSION['asigando'] = $_GET['asigando'];
$_SESSION['fechaDesde'] = $_GET['fechaDesde'];
$_SESSION['fechaHasta'] = $_GET['fechaHasta'];
?>

