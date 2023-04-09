<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_GET["Txtmedico"])) {
    $diaSeleccionado = $_GET["prueba"];
    $query = "SELECT 
    *
FROM
    users AS u
        INNER JOIN
    tbl_horario_atencion_medicos AS h ON h.llaveMedicoHorario = u.id
        INNER JOIN
    tbl_ciudad AS c ON c.id_ciudad = h.llaveCiudadAtencionMedico WHERE id ='" . $_GET["Txtmedico"] . "'";

    $medico = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <?php
        while ($medicoInof = mysqli_fetch_array($medico)) {
            ?>
            <div class="row" id="ocu">
                <div class="col-2"> 
                    <label>Ciudad</label>
                    <input type="text" class="form-control form-control-sm" value="<?php echo $medicoInof['ciudad']; ?>" readonly>
                </div>

                <div class="col-8"> 
                    <label>Direccion</label>
                    <input type="text"  class="form-control form-control-sm" value="<?php echo $medicoInof['direccionConsultorio']; ?>"  readonly>
                </div>

                <?php
            }
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
        WHERE u.id ='" . $_GET["Txtmedico"] . "' AND diaCita = '$diaSeleccionado')";
            $medicoHoras = mysqli_query($conexion1, $horas);
            $user_count = $con->numRows($horas);
            if ($user_count > 0) {
                ?>

                <div class="col-2"> 
                    <label>Hora Cita</label>
                    <select class="form-control form-control-sm diga"    id="TxtHoraCita" name="TxtHoraCita"  required="" >
                        <option value="">Seleccionar</option>
                        <?php
                        while ($medicoMuestraHoras = mysqli_fetch_array($medicoHoras)) {
                            ?>
                            <option value="<?php echo $medicoMuestraHoras['idHorasCitas']; ?>"><?php echo $medicoMuestraHoras['horaCita']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>


            <?php
        }
    } else {
        ?>

        <?php
    }
}
?>