<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_GET["TxtIdmedico"])) {
    $idmedico = $_GET["TxtIdmedico"];
    $diacita = $_GET["TxtDiaCita"];
    $act = $_GET["TxtIdCale"];



    $actual = "SELECT 
    idHorasCitas,horaCita
FROM
    tbl_horas_citas AS h
        INNER JOIN
    tbl_union_horas_citas AS uh ON uh.llaveHorasTrabajo = h.idHorasCitas
        INNER JOIN
    users AS us ON us.id = uh.llaveMedicoHoras
WHERE
    idHorasCitas = (SELECT 
            llaveHoraCita
        FROM
            users AS u
                INNER JOIN
            tbl_calendarios AS c ON c.llaveMedico = u.id
        WHERE idcalendario='$act')";
    $actualHoras = mysqli_query($conexion1, $actual);
    $actual_count = $con->numRows($actual);
    if ($actual_count > 0) {

        while ($actualityHoras = mysqli_fetch_array($actualHoras)) {
            ?>
<option value="<?php echo $actualityHoras['idHorasCitas']; ?>" selected=""><?php echo $actualityHoras['horaCita']; ?></option>
            <?php
        }
    }



    /* ======================================= */
    $horas = "SELECT 
    idHorasCitas,horaCita
FROM
    tbl_horas_citas AS h
        INNER JOIN
    tbl_union_horas_citas AS uh ON uh.llaveHorasTrabajo = h.idHorasCitas
        INNER JOIN
    users AS us ON us.id = uh.llaveMedicoHoras
WHERE
    idHorasCitas NOT IN (SELECT 
            llaveHoraCita
        FROM
            users AS u
                INNER JOIN
            tbl_calendarios AS c ON c.llaveMedico = u.id
        WHERE u.id ='$idmedico' AND diaCita = date('$diacita'))";
    $medicoHoras = mysqli_query($conexion1, $horas);
    $user_count = $con->numRows($horas);
    if ($user_count > 0) {

        while ($medicoMuestraHoras = mysqli_fetch_array($medicoHoras)) {
            ?>
            <option value="<?php echo $medicoMuestraHoras['idHorasCitas']; ?>"><?php echo $medicoMuestraHoras['horaCita']; ?></option>
            <?php
        }
    }
} else {
    ?>

    <?php
}
?>