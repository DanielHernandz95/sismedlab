@extends('./plantilla.templateEl')
@section('tatle','app')

@section('formulario')

<?php
//require_once('/PHPExcelPrueba/Classes/PHPExcel.php');
session_start();
require_once('dist/js/consulta/conexion.php');
$con = new DBController();
$connexionInsert = conexion::getConexion();
//error_reporting(0);
?>
@include('../../../PHPExcelPrueba.Classes.PHPExcel')
@include('../../../PHPExcelPrueba.Classes.PHPExcel.Reader.Excel2007')

<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <section class="content col-12">
                    <div class="row" id="alertasDiv" style="display: none">
                        <div class=" col-12">                            
                            <div class="card-body">
                                <div class="row">  
                                    <!-- /.card-header -->
                                    <div class="card-body row" >
                                        <div class="row col-12" >
                                            <div class="col-3 testigo" style="display: none"  id="callout-1">
                                                <div class="callout callout-1">
                                                    <b> Canal Entrada no existe</b>
                                                </div>
                                            </div>                                                                    
                                            <div class="col-3 testigo" style="display: none" id="callout-2">
                                                <div class="callout callout-8 ">
                                                    <b>Siniestro ya existe</b>
                                                </div>
                                            </div>  
                                            <div class="col-4 testigo" style="display: none" id="callout-3">
                                                <div class="callout callout-12 ">
                                                    <b>Tipo Doc. Empresa no existe</b>
                                                </div>
                                            </div>  
                                            <div class="col-3 testigo" style="display: none" id="callout-4">
                                                <div class="callout callout-4 ">
                                                    <b> Profesional no existe</b>
                                                </div>
                                            </div> 
                                            <div class="col-3 testigo" style="display: none" id="callout-5">
                                                <div class="callout callout-10 ">
                                                    <b>Tipo Doc. Trab no existe</b>
                                                </div>
                                            </div> 
                                            <div class="col-3 testigo" style="display: none" id="callout-6">
                                                <div class="callout callout-6 ">
                                                    <b>Tipo solicitud  no existe</b>
                                                </div>
                                            </div> 
                                        </div> 

                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card card-default color-palette-box col-12">
                <div class="card-header car contornoTitulo">
                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Cargue Masivo</b></h3>
                </div>                   
                <!--===================Boton cargar Archivo===================-->
                <div style="margin-left: 25%;margin-top: 2%; margin-bottom: 2%;" id="seOcultaCarga"> 
                    <form name="importa" method="POST"  enctype="multipart/form-data" >
                        @csrf
                        <div class="input-group col-8 ">
                            <span class="input-group-btn">
                                <button id="fake-file-button-browse" type="button" class="btn btn-block btn-outline-warning btn-sm color_texto">
                                    <i class="fas fa-file-excel fa-lg">&nbsp;</i><b>SELECCIONAR</b>
                                </button>                                                             
                            </span>
                            <input type="file" name="excel" id="files-input-upload" class="form-control form-control-sm"  style="display:none">
                            <input type="text" id="fake-file-input-name" disabled="disabled"  class="form-control form-control-sm" placeholder="Seleccione un archivo" >
                            <input type="hidden" value="TxtVer" name="action" />
                            <span class="input-group-btn">
                                <button type='submit' class="btn btn-block btn-outline-success btn-sm color_texto"  disabled="" id="fake-file-button-upload">
                                    <i class="fas fa-upload"></i><b> CARGAR</b>
                                </button>

                            </span>
                        </div>
                    </form>
                </div>   
                <!--===================Fin Boton cargar Archivo===================-->
                <!--===================Fin Cargar Archivo===================-->
                <?php
                $quienCrea = Auth::user()->id;
                $action = NULL;
                $archivo = NULL;
                extract($_POST);
                if ($action == "TxtVer") {
                    $archivo = $_FILES['excel']['name']; //captura el nombre del archivo
                    $_SESSION ['archi'] = $_FILES['excel']['name'];
                    $tipo = $_FILES['excel']['type']; //captura el tipo de archivo (2003 o 2007)
                    $destino = "../resources/views/moduloEl/admin/cargue/bak_" . $archivo; //lugar donde se copiara el archivo
                    if (copy($_FILES['excel']['tmp_name'], $destino)) { //si dese copiar la variable excel (archivo).nombreTemporal a destino (bak_.archivo) (si se ha dejado copiar)
                        ?>
                        <!--===================Fin Cargar Archivo===================-->
                        <!--===================Tabla===================-->
                        <input id="OcultarBotnArchivo" value="1" hidden="">
                        <div class="ajusteDivTabla sc6">
                            <table id="cargueTabla" class="table table-bordered table-striped tablaAjuste"  style="">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Canal entrada</th>
                                        <th>Tipo Solicitud</th>
                                        <th>Tipo Doc. Trab</th> 
                                        <th>Documento</th>   
                                        <th>Nombres y Apellidos</th>
                                        <th>Tipo Doc. Empresa</th>  
                                        <th>Documento Empresa</th>  
                                        <th>Razón social</th>  
                                        <th>Fecha Diagnóstico</th>                                     
                                        <th>Origen</th>
                                        <th>Fecha Radiación</th>
                                        <th>Medico calificador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $archiv = "../resources/views/moduloEl/admin/cargue/bak_" . $_SESSION['archi'];
                                    $inputFileType = PHPExcel_IOFactory::identify($archiv);
                                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                    $objPHPExcel = $objReader->load($archiv);
                                    $sheet = $objPHPExcel->getSheet(0);
                                    $highestRow = $sheet->getHighestRow();
                                    $highestColumn = $sheet->getHighestColumn();
                                    $idContador = 2;

                                    $alertaEntrada = 0;
                                    $alertaTipoDocuAfili = 0;
                                    $alertaTipoDocumeEmpresa = 0;
                                    $alertaProfesional = 0;
                                    $alertaSolicitud = 0;
                                    $alertaSiniestro = 0;
                                    for ($row = 2; $row <= $highestRow; $row++) {

                                        $tablacanalEntrada = $sheet->getCell("A" . $row)->getValue();
                                        $tablaSolicitud = $sheet->getCell("B" . $row)->getValue();
                                        $tablaDomuentoAfliliado = $sheet->getCell("C" . $row)->getValue();
                                        $tablaDocumento = $sheet->getCell("D" . $row)->getValue();
                                        $tablaNombreAfiliado = $sheet->getCell("E" . $row)->getValue();
                                        $tablaTipoDocumenEmpresa = $sheet->getCell("F" . $row)->getValue();
                                        $tablaDocumenEmpresa = $sheet->getCell("G" . $row)->getValue();
                                        $tablaRazonSocial = $sheet->getCell("H" . $row)->getValue();
                                        $tablaFechaDiag = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('I' . $row)->getCalculatedValue(), 'YYYY-MM-DD');
//                                        $tablaNombreMedico = $sheet->getCell("J" . $row)->getValue();
//                                        $tablaRegistroMedi = $sheet->getCell("K" . $row)->getValue();
//                                        $tablaFechaInforme = $sheet->getCell("L" . $row)->getValue();
                                        $tablaOrigen = $sheet->getCell("J" . $row)->getValue();
                                        $tablaFechaRadiacacion = $sheet->getCell("K" . $row)->getValue();
                                        $tablaMedico = $sheet->getCell("L" . $row)->getValue();
                                        ?>
                                        <tr>    

                                            <?php
                                            $siniestro = "SELECT 
                                                            id_elSiniestro
                                                        FROM
                                                            db_spiatel.tbl_el_siniestros AS s
                                                                INNER JOIN
                                                            tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliadoEl
                                                                INNER JOIN
                                                            tbl_entrada AS e ON e.id_entrada = s.llaveCanlaEntradaEl
                                                                INNER JOIN
                                                            tbl_solicitud AS so ON so.id_solicitud = s.llaveTipoSolicitudEl
                                                        WHERE
                                                            documento = '$tablaDocumento' AND solicitud = BINARY '$tablaSolicitud'
                                                                AND entrada = BINARY '$tablacanalEntrada' AND fechaEnfermedad = '$tablaFechaDiag';";
                                            $siniestroCount = $con->numRows($siniestro);
                                            if ($siniestroCount == 0) {
                                                ?>                                                
                                                <td><span><b><?php echo $idContador ?></b></span></td>
                                                <?php
                                            } else {
                                                $alertaSiniestro += 1;
                                                ?>
                                                <td style="background-color: #A5D6A7" ><span><b><?php echo $idContador ?></b></span></td>

                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $entrada = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_entrada WHERE entrada = BINARY '$tablacanalEntrada' and procesoEntrada= 'EL'";
                                            $entradaCount = $con->numRows($entrada);
                                            if ($entradaCount == 0) {
                                                $alertaEntrada += 1;
                                                ?>
                                                <td style="background-color: #EF9A9A"><span><b><?php echo $sheet->getCell("A" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><span><b><?php echo $sheet->getCell("A" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            }
                                            ?>  

                                            <?php
                                            $solicitud = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_solicitud WHERE solicitud = BINARY '$tablaSolicitud' and procesoSolicitud = 'EL'";
                                            $solicitudCount = $con->numRows($solicitud);
                                            if ($solicitudCount == 0) {
                                                $alertaSolicitud += 1;
                                                ?>
                                                <td style="background-color: #81D4FA" ><span><b><?php echo $sheet->getCell("B" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td ><span><b><?php echo $sheet->getCell("B" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $documentoAfili = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_tipo_docuemtno WHERE tipo_documento = BINARY '$tablaDomuentoAfliliado'";
                                            $docAfiliCount = $con->numRows($documentoAfili);
                                            if ($docAfiliCount == 0) {
                                                $alertaTipoDocuAfili += 1;
                                                ?>
                                                <td style="background-color: #E6EE9C"><span><b><?php echo $sheet->getCell("C" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><span><b><?php echo $sheet->getCell("C" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            }
                                            ?> 
                                            <td><span><b><?php echo $sheet->getCell("D" . $row)->getValue(); ?></b></span></td>
                                            <td><span><b><?php echo $sheet->getCell("E" . $row)->getValue(); ?></b></span></td>
                                            <?php
                                            $documentoEmpresa = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_tipo_documento_empreza WHERE tipo_documento_empreza = BINARY '$tablaTipoDocumenEmpresa'";
                                            $tipoDocuEmpreCount = $con->numRows($documentoEmpresa);
                                            if ($tipoDocuEmpreCount == 0) {
                                                $alertaTipoDocumeEmpresa += 1;
                                                ?>
                                                <td style="background-color: #BCAAA4"><span><b><?php echo $sheet->getCell("F" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><span><b><?php echo $sheet->getCell("F" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            }
                                            ?> 
                                            <td><span><b><?php echo $sheet->getCell("G" . $row)->getValue(); ?></b></span></td>
                                            <td><span><b><?php echo $sheet->getCell("H" . $row)->getValue(); ?></b></span></td>
                                            <td ><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("I" . $row)->getValue(), 'YYYY-MM-DD'); ?></b></span></td>




                                            <td><span><b><?php echo $sheet->getCell("J" . $row)->getValue(); ?></b></span></td>
                                            <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("K" . $row)->getValue(), 'YYYY-MM-DD'); ?></b></span></td>
                                            <?php
                                            $asignar = "SELECT 
                                                        *
                                                    FROM
                                                       users WHERE name = BINARY '$tablaMedico' and llave_estado = '1'";
                                            $asignarCount = $con->numRows($asignar);
                                            if ($asignarCount == 0) {
                                                $alertaProfesional += 1;
                                                ?>
                                                <td style="background-color: #9FA8DA" ><span><b><?php echo $sheet->getCell("L" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td ><span><b><?php echo $sheet->getCell("L" . $row)->getValue(); ?></b></span></td>
                                                <?php
                                            }
                                            ?>



                                        </tr>                      
                                        <?php
                                        $idContador += 1;
                                        /* ===================================Agregar Empresa============================= */
                                        $agregarEmpresa = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_empresas WHERE nit =  '$tablaTipoDocumenEmpresa'";
                                        $creaEmpreCount = $con->numRows($agregarEmpresa);
                                        if ($creaEmpreCount == 0) {


                                            $queryEmpresa = $conexion1->query("INSERT INTO `tbl_empresas` (`nit`, `razon_social_empleador`, "
                                                    . "`llave_departamento`) VALUES ('$tablaTipoDocumenEmpresa', '$tablaRazonSocial');");
                                        }
                                        /* ===================================Agregar Empleado============================= */
                                        $agregarAfiliado = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_afiliados WHERE documento = '$tablaDocumento'";
                                        $afiliadoCrearCount = $con->numRows($agregarAfiliado);
                                        if ($afiliadoCrearCount == 0) {
                                            $queryAfiliado = $conexion1->query("INSERT INTO `tbl_afiliados` (`documento`, `nombre`) "
                                                    . "VALUES ('$tablaDocumento', '$tablaNombreAfiliado');");
                                        }
                                        /* ===================================Fin Empleado============================= */
                                    }
                                    ?>
                                </tbody>
                            </table>                                    
                        </div>
                        <br>
                        <form name="importa" method="POST"  enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" value="upload" name="action" />
                            <div class="col-sm-8 " style="margin-left:40%;" id="botonImportar">
                                <div class="col-md-3 col-sm-3 col-xs-12" >    
                                    <button type='submit' class="btn btn-block btn-outline-success  color_texto" >
                                        <i class="fas fa-upload"></i><b> Importar</b>
                                    </button>
                                </div> 
                            </div>
                        </form>
                        <!--===================Fin tabla===================-->

                        <?php
                        if ($alertaEntrada > 0) {
                            ?>
                            <input id="cargueEntrada" value="1" hidden="">
                            <?php
                        }
                        if ($alertaProfesional > 0) {
                            ?>
                            <input id="cargueAsignar" value="1" hidden="">
                            <?php
                        }
                        if ($alertaTipoDocuAfili > 0) {
                            ?>
                            <input id="cargueTipoDoAfili" value="1" hidden="">
                            <?php
                        }
                        if ($alertaTipoDocumeEmpresa > 0) {
                            ?>
                            <input id="cargueTipoDoAEmpresa" value="1" hidden="">
                            <?php
                        }
                        if ($alertaSolicitud > 0) {
                            ?>
                            <input id="cargueTipoSilicitud" value="1" hidden="">
                            <?php
                        }
                        if ($alertaSiniestro > 0) {
                            ?>
                            <input id="cargueSiniestro" value="1" hidden="">
                            <?php
                        }
                    } else {
                        ?>
                        <script>
                            Swal.fire({
                                title: 'Oops...',
                                type: 'warning',
                                text: 'El siniestro ya se encuentra registrado en el sistema!'
                            });
                        </script>
                        <?php
                    }
                    ?>

                    <?php
                }
                /* ======================= Accion Cargar a la base de Datos =========================== */
                extract($_POST);
                if ($action == "upload") {
                    $archivo = $_SESSION['archi'];

                    $destino = "../resources/views/moduloEl/admin/cargue/bak_" . $_SESSION['archi'];
                    if (file_exists("../resources/views/moduloEl/admin/cargue/bak_" . $_SESSION['archi'])) {
                        $objReader = new PHPExcel_Reader_Excel2007();
                        $objPHPExcel = $objReader->load("../resources/views/moduloEl/admin/cargue/bak_" . $archivo);
                        $objFecha = new PHPExcel_Shared_Date();
                        $objPHPExcel->setActiveSheetIndex(0);
                        $i = 1;
                        $param = 0;
                        $contador = 0;
                        $suma = 0;
                        while ($param == 0) {
                            $EntradaBase = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                            $solicitudBase = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                            $tipoDocumAfili = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                            $ccBase = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                            $nombreAfiliado = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                            $tipoDocuEmpre = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                            $nitBase = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                            $razonBase = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
                            $fechaDiagnos = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
//                            $nombreMedico = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
//                            $registro = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
//                            $fechaInforme = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
//                           
                            $origen = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
                            $fechaRadicacion = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
                            $asignarBase = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();

                            $asignar = "SELECT 
                                                        *
                                                    FROM
                                                       users WHERE name = BINARY '$asignarBase' and llave_estado = '1'";
                            $asignarCon = mysqli_query($conexion1, $asignar);
                            while ($resulasignar = mysqli_fetch_array($asignarCon, MYSQLI_ASSOC)) {
                                $queryUser = $resulasignar['id'];
                                /* =========================Entrada============================ */
                                $entrada = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_entrada WHERE entrada = BINARY '$EntradaBase' and procesoEntrada= 'EL'";
                                $entradaCon = mysqli_query($conexion1, $entrada);
                                while ($resulEntrada = mysqli_fetch_array($entradaCon, MYSQLI_ASSOC)) {
                                    $queryEntrada = $resulEntrada['id_entrada'];


                                    /* =========================Solicitud============================ */
                                    $solicitud = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_solicitud WHERE solicitud = BINARY '$solicitudBase' and procesoSolicitud = 'EL'";
                                    $solicitudCon = mysqli_query($conexion1, $solicitud);
                                    while ($resulSolicitud = mysqli_fetch_array($solicitudCon, MYSQLI_ASSOC)) {
                                        $querySolicitud = $resulSolicitud['id_solicitud'];


                                        /* =========================EMPRESA============================ */
                                        $nitMas = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_empresas WHERE nit = '$nitBase'";
                                        $masDeUna = $con->numRows($nitMas);
                                        if ($masDeUna > 1) {
                                            /* =========================Empresa si hay ma de una por nit============================ */
                                            $nit = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_empresas WHERE razon_social_empleador = '$razonBase'";
                                        } else {
                                            /* =========================Empresa si hay una por nit============================ */

                                            $nit = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_empresas WHERE nit = '$nitBase'";
                                        }

                                        $nitCon = mysqli_query($conexion1, $nit);
                                        while ($resulNit = mysqli_fetch_array($nitCon, MYSQLI_ASSOC)) {
                                            $queryNitR = $resulNit['id_empresa'];


                                            /* =========================Afiliado============================ */
                                            $afiliado = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_afiliados WHERE documento = '$ccBase'";
                                            $afiliadoCon = mysqli_query($conexion1, $afiliado);
                                            while ($resulAfiliado = mysqli_fetch_array($afiliadoCon, MYSQLI_ASSOC)) {
                                                $queryafiliadoR = $resulAfiliado['idAfiliado'];
                                                /* =========================Inser del siniestro============================ */

                                                $query = $connexionInsert->query("INSERT INTO `tbl_el_siniestros` (`llaveCanlaEntradaEl`,`llaveTipoSolicitudEl`,"
                                                        . " `llaveAfiliadoEl`, `llaveEmpresaEl`,`fechaEnfermedad`, "
                                                        . " `origen`, `fechaRadicacion`,`creacion`)"
                                                        . " VALUES ('$queryEntrada','$querySolicitud', '$queryafiliadoR', '$queryNitR','$fechaDiagnos', "
                                                        . " '$origen', '$fechaRadicacion','CARGUE MASIVO')");

                                                $siniestroId = $connexionInsert->lastInsertId();


                                                $tarza = $connexionInsert->query("INSERT INTO `tbl_trazas` (`tipo`, `llaveSiniestroEL`, `llaveUserPcTtraza`)"
                                                        . " VALUES ('CREACION SINIESTRO CARGUE MASIVO', '$siniestroId','$quienCrea')");


                                                /* =========================Inser Prercalificacion============================ */
                                                $calificacion = $connexionInsert->query("INSERT INTO `tbl_el_calificaciones` (`llaveEstadoElCalificacion`, `llaveUsuarioCalificadorEl`)"
                                                        . " VALUES ('1', '$queryUser')");

                                                $calificacionId = $connexionInsert->lastInsertId();

                                                $updateCalioficacion = $connexionInsert->query("UPDATE `tbl_el_siniestros` SET `llaveCalificacionEl` = '$calificacionId' "
                                                        . "WHERE (`id_elSiniestro` = '$siniestroId')");

                                                $suma = $suma + 1;
                                            }
                                        }
                                    }
                                }
                            }
                            if ($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue() == NULL) {
                                $param = 1;
                            }
                            $i++;
                            $contador = $contador + 1;
                        }
                        $totalIngresados = $contador - 1;
                        ?>
                        <script>
                            Swal.fire({
                                title: 'Cargue exitoso',
                                type: 'success',
                                text: 'Registros cargados: <?php echo $suma ?> de <?php echo $totalIngresados - 1 ?>'
                            });
                        </script>
                        <?php
                    }
                    unlink($destino);
                }
                ?>
            </div>
            </section>
        </div>
    </div>
</div>
</div>
@endsection

