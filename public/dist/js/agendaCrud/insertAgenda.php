<?php

// Conexion a la base de datos
include '../consulta/conexion.php';

if (!empty($_GET['TxtDiaCita'])) {

    $dia = $_GET['TxtDiaCita'];
    $medico = $_GET['Txtmedico'];
    $hora = $_GET['TxtHoraCita'];
    $idAfiliado = $_GET['TxtIdAfiliado'];
    $tipoConsultaa = $_GET['TxtTipoConsulta'];

    $sql = "INSERT INTO tbl_calendarios(`color`,`llaveMedico`, `llaveAfiliadoAgenda`, `diaCita`,`finCita`, `llaveHoraCita`, `llaveTipoConsulta`) values ('#E5B300','$medico', '$idAfiliado', '$dia','$dia', '$hora' , '$tipoConsultaa')";



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
