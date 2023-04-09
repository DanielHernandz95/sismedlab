<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["TxtSiniestroPcl"])) {
    $query = "SELECT 
    *
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_seguimientos AS se ON se.llaveSiniestroPcl = s.idSiniestroPcl
        INNER JOIN
    users AS u ON u.id = se.llaveRevisadoPor
        INNER JOIN
    tbl_sub_estado_seguimientos AS su ON su.idSub_estado_seguimientos = se.llaveSubEstado WHERE idSiniestroPcl='" . $_POST["TxtSiniestroPcl"] . "'";
    $infoSeg = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        while ($seg = mysqli_fetch_array($infoSeg)) {
            ?>
            <div class="row">
                <div class="col-3 date">
                    <label>Fecha <?php echo $seg['tipoSeguimiento'] ?> contacto</label>
                    <div class="input-group date">
                        <input class="form-control form-control-sm" value="<?php echo $seg['fechaSeguimiento'] ?>">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div> 
                </div>
                <div class="col-2">
                    <label>SubEstado</label>
                    <input class="form-control form-control-sm" value="<?php echo $seg['subEstadoSeguimiento'] ?>">
                </div>                                    
                <div class="col-2">
                    <label>Revisado por</label>
                    <input class="form-control form-control-sm" value="<?php echo $seg['name'] ?>">
                </div>    
                <div class="form-group col-12">
                    <label>Seguimiento</label>
                    <textarea  class="form-control" rows="3"  name="TxtSeguimiento"><?php echo $seg['seguimiento'] ?></textarea>
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


