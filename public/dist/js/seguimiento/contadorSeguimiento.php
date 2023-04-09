

<?php
// Conexion a la base de datos
include '../consulta/conexion.php';
$con = new DBController();

if (!empty($_POST["TxtSiniestroPclSe"])) {
    $query = "SELECT 
 *
FROM
    tbl_siniestro_pcls AS s
        left JOIN
    tbl_seguimientos AS se ON se.llaveSiniestroPcl = s.idSiniestroPcl
     WHERE idSiniestroPcl ='" . $_POST["TxtSiniestroPclSe"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count < 3) {
        ?>
        <div class="form-group col-sm-8 input-group-sm row" style="margin-left:0%;" >
            <div class="col-md-4 col-sm-3 col-xs-12" >    
                <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " onclick="Seguimiento();" >Agregar Seguimiento </button>
            </div>
        </div> 
        <input type="hidden" name="TxtTipoSeguimiento" id="TxtTipoSeguimiento" value="<?php echo $user_count ?>" class="form-control form-control-sm ">
        <?php
    }
}
?>