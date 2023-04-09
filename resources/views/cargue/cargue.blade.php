@extends('plantilla.template')
@section('tatle','app')

@section('formulario')

<?php
//require_once('/PHPExcelPrueba/Classes/PHPExcel.php');
session_start();
require_once('dist/js/consulta/conexion.php');
$con = new DBController();
$connexionInsert = conexion::getConexion();
error_reporting(0);
?>
@include('PHPExcelPrueba.Classes.PHPExcel')
@include('PHPExcelPrueba.Classes.PHPExcel.Reader.Excel2007')

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
                                            <div class="col-3 testigo" style="display: none" id="callout-3">
                                                <div class="callout callout-3 ">
                                                    <b> Precalificacion no existe</b>
                                                </div>
                                            </div>
                                            <div class="col-4 testigo" style="display: none" id="callout-4">
                                                <div class="callout callout-4 ">
                                                    <b>  Requiere val. presencial no existe</b>
                                                </div>
                                            </div>
                                            <div class="col-3 testigo" style="display: none" id="callout-5">
                                                <div class="callout callout-5 ">
                                                    <b> Quin solicita no existe</b>
                                                </div>
                                            </div>                                    
                                            <div class="col-3 testigo" style="display: none" id="callout-8">
                                                <div class="callout callout-8 ">
                                                    <b>Siniestro ya existe</b>
                                                </div>
                                            </div>                                        
                                            <div class="col-3 testigo" style="display: none" id="callout-10">
                                                <div class="callout callout-10 ">
                                                    <b> Tipo evento no existe</b>
                                                </div>
                                            </div>
                                            <div class="col-3 testigo" style="display: none" id="callout-11">
                                                <div class="callout callout-11 ">
                                                    <b>  Tipo solicitud no existe</b>
                                                </div>
                                            </div>  
                                            <div class="col-3 testigo" style="display: none" id="callout-12">
                                                <div class="callout callout-12 ">
                                                    <b> Profesional no existe</b>
                                                </div>
                                            </div>
                                            <div class="col-3 testigo" style="display: none" id="callout-13">
                                                <div class="callout callout-13 ">
                                                    <b> Sucursal no existe</b>
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
                            $destino = "../resources/views/cargue/bak_" . $archivo; //lugar donde se copiara el archivo
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
                                                <th>Canal Entrada</th>
                                                <th>Fecha asignación del cliente</th>
                                                <th>Precalificación</th>
                                                <th>Requiere val. presencial </th> 
                                                <th>Fecha Asig. al profesional</th>  
                                                <th>Quien solicita</th>
                                                <th>Número identificación Afiliado</th> 
                                                <th>Siniestro</th>   
                                                <th>Nombre usuario</th>         
                                                <th>NIT</th>  
                                                <th>Razón Social</th>  
                                                <th>Sucursal</th>  
                                                <th>Tipo evento</th>
                                                <th>Tipo de solicitud</th>
                                                <th>Calificacion formal</th>
                                                <th>Posible cero</th>
                                                <th>Asignar a</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $archiv = "../resources/views/cargue/bak_" . $_SESSION['archi'];
                                            $inputFileType = PHPExcel_IOFactory::identify($archiv);
                                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                            $objPHPExcel = $objReader->load($archiv);
                                            $sheet = $objPHPExcel->getSheet(0);
                                            $highestRow = $sheet->getHighestRow();
                                            $highestColumn = $sheet->getHighestColumn();
                                            $idContador = 2;

                                            $alertaEntrada = 0;
                                            $alertaPre = 0;
                                            $alertaRequiere = 0;
                                            $alertaQuien = 0;
                                            $alertaSiniestro = 0;
                                            $alertaEvento = 0;
                                            $alertaSolicitud = 0;
                                            $alertaProfesional = 0;
                                            $alertaSucursal = 0;
                                            for ($row = 2; $row <= $highestRow; $row++) {

                                                $tablacanalEntrada = $sheet->getCell("A" . $row)->getValue();
                                                $tablaPre = $sheet->getCell("C" . $row)->getValue();
                                                $tablarequiere = $sheet->getCell("D" . $row)->getValue();
                                                $tablaQuien = $sheet->getCell("F" . $row)->getValue();
                                                $tablaAfilidocc = $sheet->getCell("G" . $row)->getValue();
                                                $tablaNombreAfi = $sheet->getCell("I" . $row)->getValue();
                                                $tablaNit = $sheet->getCell("J" . $row)->getValue();
                                                $tablaSinestro = $sheet->getCell("H" . $row)->getValue();
                                                $tablaEvento = $sheet->getCell("M" . $row)->getValue();
                                                $tablaSolicitud = $sheet->getCell("N" . $row)->getValue();
                                                $tablaAsignar = $sheet->getCell("Q" . $row)->getValue();
                                                $tablaRazon = $sheet->getCell("K" . $row)->getValue();
                                                $tablaSucursal = $sheet->getCell("L" . $row)->getValue();
                                                ?>
                                                <tr>    
                                                    <td><span><b><?php echo $idContador ?></b></span></td>
                                                    <?php
                                                    $entrada = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_entrada WHERE entrada = BINARY '$tablacanalEntrada' and procesoEntrada= 'PCL'";
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
                                                    <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("B" . $row)->getValue(), 'YYYY-MM-DD'); ?></b></span></td>
                                                    <?php
                                                    if ($tablaPre == 'SI' or $tablaPre == 'NO') {
                                                        ?>
                                                        <td ><span><b><?php echo $sheet->getCell("C" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        $alertaPre += 1;
                                                        ?>
                                                        <td style="background-color: #B39DDB"><span><b><?php echo $sheet->getCell("C" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($tablarequiere == 'SI' or $tablarequiere == 'NO') {
                                                        ?>
                                                        <td ><span><b><?php echo $sheet->getCell("D" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        $alertaRequiere += 1;
                                                        ?>
                                                        <td style="background-color: #9FA8DA"><span><b><?php echo $sheet->getCell("D" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td><span><b><?php echo PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell("E" . $row)->getValue(), 'YYYY-MM-DD'); ?></b></span></td>
                                                    <?php
                                                    $quien = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_quien_solicita WHERE quien_solicita = BINARY '$tablaQuien' and procesoQuienSolicita= 'PCL'";
                                                    $quienCount = $con->numRows($quien);
                                                    if ($quienCount == 0) {
                                                        $alertaQuien += 1;
                                                        ?>
                                                        <td style="background-color: #90CAF9"><span><b><?php echo $sheet->getCell("F" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td><span><b><?php echo $sheet->getCell("F" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>                                                   
                                                    <td><span><b><?php echo $sheet->getCell("G" . $row)->getValue(); ?></b></span></td>
                                                    <?php
                                                    $siniestro = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_siniestro_pcls WHERE idSiniestro = '$tablaSinestro' ";
                                                    $siniestroCount = $con->numRows($siniestro);
                                                    if ($siniestroCount == 0) {
                                                        ?>                                                
                                                        <td ><span><b><?php echo $sheet->getCell("H" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        $alertaSiniestro += 1;
                                                        ?>
                                                        <td style="background-color: #A5D6A7"><span><b><?php echo $sheet->getCell("H" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td><span><b><?php echo $sheet->getCell("I" . $row)->getValue(); ?></b></span></td>
                                                    <td><span><b><?php echo $sheet->getCell("J" . $row)->getValue(); ?></b></span></td>
                                                    <td><span><b><?php echo $sheet->getCell("K" . $row)->getValue(); ?></b></span></td>
                                                    <?php
                                                    $sucursal = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_departamento WHERE departamento = BINARY '$tablaSucursal'";
                                                    $sucurCount = $con->numRows($sucursal);
                                                    if ($sucurCount == 0) {
                                                        $alertaSucursal += 1;
                                                        ?>
                                                        <td style="background-color: #90CAF9"><span><b><?php echo $sheet->getCell("L" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td><span><b><?php echo $sheet->getCell("L" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $evento = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_tipo_evento WHERE tipo_evento = BINARY '$tablaEvento'";
                                                    $eventoCount = $con->numRows($evento);
                                                    if ($eventoCount == 0) {
                                                        $alertaEvento += 1;
                                                        ?>
                                                        <td style="background-color: #E6EE9C"><span><b><?php echo $sheet->getCell("M" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td ><span><b><?php echo $sheet->getCell("M" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $solicitud = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_solicitud WHERE solicitud = BINARY '$tablaSolicitud' and procesoSolicitud = 'PCL'";
                                                    $solicitudCount = $con->numRows($solicitud);
                                                    if ($solicitudCount == 0) {
                                                        $alertaSolicitud += 1;
                                                        ?>
                                                        <td style="background-color: #FFF59D" ><span><b><?php echo $sheet->getCell("N" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td ><span><b><?php echo $sheet->getCell("N" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td><span><b><?php echo $sheet->getCell("O" . $row)->getValue(); ?></b></span></td>
                                                    <td><span><b><?php echo $sheet->getCell("P" . $row)->getValue(); ?></b></span></td>
                                                    <?php
                                                    $asignar = "SELECT 
                                                        *
                                                    FROM
                                                       users WHERE name = BINARY '$tablaAsignar' and llave_estado = '1'";
                                                    $asignarCount = $con->numRows($asignar);
                                                    if ($asignarCount == 0) {
                                                        $alertaProfesional += 1;
                                                        ?>
                                                        <td style="background-color: #BCAAA4" ><span><b><?php echo $sheet->getCell("Q" . $row)->getValue(); ?></b></span></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td ><span><b><?php echo $sheet->getCell("Q" . $row)->getValue(); ?></b></span></td>
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
                                                       tbl_empresas WHERE nit =  '$tablaNit'";
                                                $creaEmpreCount = $con->numRows($agregarEmpresa);
                                                if ($creaEmpreCount == 0) {

                                                    $departamento = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_departamento WHERE departamento = BINARY '$tablaSucursal'";
                                                    $departamentoCon = mysqli_query($conexion1, $departamento);
                                                    while ($resulDepartamento = mysqli_fetch_array($departamentoCon, MYSQLI_ASSOC)) {
                                                        $queryDe = $resulDepartamento['id_departamento'];
                                                        $queryEmpresa = $conexion1->query("INSERT INTO `tbl_empresas` (`nit`, `razon_social_empleador`, "
                                                                . "`llave_departamento`) VALUES ('$tablaNit', '$tablaRazon', '$queryDe');");
                                                    }
                                                }
                                                /* ===================================Agregar Empleado============================= */
                                                $agregarAfiliado = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_afiliados WHERE documento = '$tablaAfilidocc'";
                                                $afiliadoCrearCount = $con->numRows($agregarAfiliado);
                                                if ($afiliadoCrearCount == 0) {
                                                    $queryAfiliado = $conexion1->query("INSERT INTO `tbl_afiliados` (`documento`, `nombre`) "
                                                            . "VALUES ('$tablaAfilidocc', '$tablaNombreAfi');");
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
                                if ($alertaSucursal > 0) {
                                    ?>
                                    <input id="cargueSucursal" value="1" hidden="">
                                    <?php
                                }
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
                                if ($alertaPre > 0) {
                                    ?>
                                    <input id="carguePrecalificacion" value="1" hidden="">
                                    <?php
                                }
                                if ($alertaRequiere > 0) {
                                    ?>
                                    <input id="cargueValoracion" value="1" hidden="">
                                    <?php
                                }
                                if ($alertaQuien > 0) {
                                    ?>
                                    <input id="cargueQuien" value="1" hidden="" >
                                    <?php
                                }
                                if ($alertaSiniestro > 0) {
                                    ?>
                                    <input id="cargueSiniestro" value="1" hidden="">
                                    <?php
                                }
                                if ($alertaEvento > 0) {
                                    ?>
                                    <input id="CargueEvento" value="1" hidden="" >
                                    <?php
                                }
                                if ($alertaSolicitud > 0) {
                                    ?>
                                    <input id="cargueSolicitud" value="1" hidden="">
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

                            $destino = "../resources/views/cargue/bak_" . $_SESSION['archi'];
                            if (file_exists("../resources/views/cargue/bak_" . $_SESSION['archi'])) {
                                $objReader = new PHPExcel_Reader_Excel2007();
                                $objPHPExcel = $objReader->load("../resources/views/cargue/bak_" . $archivo);
                                $objFecha = new PHPExcel_Shared_Date();
                                $objPHPExcel->setActiveSheetIndex(0);
                                $i = 1;
                                $param = 0;
                                $contador = 0;
                                $suma = 0;
                                while ($param == 0) {
                                    $EntradaBase = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                                    $AsigCliBase = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
                                    $PreBase = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                                    $valoracionBase = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                                    $aSigProfeBase = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue(), 'YYYY-MM-DD');
                                    $quienBase = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                                    $siniestroBase = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();

                                    /* ===================================Afiliado============================= */
                                    $ccBase = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                                    $nomAfiliBase = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
                                    /* ===================================Afiliado============================= */

                                    /* ===================================Empresa============================= */
                                    $nitBase = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
                                    $razonBase = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
                                    $sucursalBase = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();
                                    /* ===================================Fin Empresa============================= */

                                    $eventoBase = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();
                                    $solicitudBase = $objPHPExcel->getActiveSheet()->getCell('N' . $i)->getCalculatedValue();
                                    $calificacionBase = $objPHPExcel->getActiveSheet()->getCell('O' . $i)->getCalculatedValue();
                                    $posibleBase = $objPHPExcel->getActiveSheet()->getCell('P' . $i)->getCalculatedValue();
                                    $asignarBase = $objPHPExcel->getActiveSheet()->getCell('Q' . $i)->getCalculatedValue();


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
                                                       tbl_entrada WHERE entrada = BINARY '$EntradaBase' and procesoEntrada= 'PCL'";
                                        $entradaCon = mysqli_query($conexion1, $entrada);
                                        while ($resulEntrada = mysqli_fetch_array($entradaCon, MYSQLI_ASSOC)) {
                                            $queryEntrada = $resulEntrada['id_entrada'];
                                            /* =========================Quien============================ */
                                            $quien = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_quien_solicita WHERE quien_solicita = BINARY '$quienBase' and procesoQuienSolicita= 'PCL'";
                                            $quienCon = mysqli_query($conexion1, $quien);
                                            while ($resulQuien = mysqli_fetch_array($quienCon, MYSQLI_ASSOC)) {
                                                $queryQuien = $resulQuien['id_quien_solicita'];
                                                /* =========================Evento============================ */

                                                $evento = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_tipo_evento WHERE tipo_evento = BINARY '$eventoBase'";
                                                $eventoCon = mysqli_query($conexion1, $evento);

                                                while ($resulEvento = mysqli_fetch_array($eventoCon, MYSQLI_ASSOC)) {
                                                    $queryEvento = $resulEvento['id_tipo_evento'];
                                                    /* =========================Solicitud============================ */
                                                    $solicitud = "SELECT 
                                                        *
                                                    FROM
                                                       tbl_solicitud WHERE solicitud = BINARY '$solicitudBase' and procesoSolicitud = 'PCL'";
                                                    $solicitudCon = mysqli_query($conexion1, $solicitud);
                                                    while ($resulSolicitud = mysqli_fetch_array($solicitudCon, MYSQLI_ASSOC)) {
                                                        $querySolicitud = $resulSolicitud['id_solicitud'];
                                                        /* =========================Empresa============================ */


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
                                                                $query = $connexionInsert->query("INSERT INTO `tbl_siniestro_pcls` (`llaveCanalEntrada`,"
                                                                        . " `llaveQuienSolicita`, `llaveTipoSolicitud`, `llaveTipoEvento`,"
                                                                        . " `fechaAsignacionDelCliente`,"
                                                                        . " `llaveListaPrecalificacion`, `idSiniestro`, `llaveAfiliado`, "
                                                                        . " `llaveEmpresaPcl`, `requiereValoracionPresencial`,"
                                                                        . " `llaveUsuarioAsigando`,`llaveUsuarioQuienCrea`)"
                                                                        . " VALUES ('$queryEntrada', '$queryQuien', '$querySolicitud', '$queryEvento',"
                                                                        . "  '$AsigCliBase', '$PreBase', '$siniestroBase', '$queryafiliadoR', '$queryNitR',"
                                                                        . " '$valoracionBase', '$queryUser', '$quienCrea')");

                                                                $siniestroId = $connexionInsert->lastInsertId();

                                                                
                                                                $tarza = $connexionInsert->query("INSERT INTO `tbl_trazas` (`tipo`, `llaveSiniestroPclUnion`, `llaveUserPcTtraza`)"
                                                                        . " VALUES ('CREACION SINIESTRO', '$siniestroId','$quienCrea')");

                                                                // $data = Modelo::latest('id')->first();
                                                                if ($PreBase == 'SI') {
                                                                    /* =========================Inser Prercalificacion============================ */
                                                                    $preCalificacion = $connexionInsert->query("INSERT INTO `tbl_precalificaciones` (`llaveCalificador`, `llaveEstadoPrecalificacion`)"
                                                                            . " VALUES ('$queryUser', '1')");

                                                                    $preCalificacionId = $connexionInsert->lastInsertId();
                                                                    $updatePreCalioficacion = $connexionInsert->query("UPDATE `tbl_siniestro_pcls` SET `llavePrecalificacion` = '$preCalificacionId'"
                                                                            . "WHERE (`idSiniestroPcl` = '$siniestroId')");
                                                                } else {
                                                                    /* =========================Inser Calificacion============================ */
                                                                    $calificacion = $connexionInsert->query("INSERT INTO `tbl_califiaciones` (`llaveCalificadorCalifiacion`, `llaveEstadoCalificacion`) "
                                                                            . "VALUES ('$queryUser', '1')");

                                                                    $calificacionId = $connexionInsert->lastInsertId();
                                                                    $updateCalioficacion = $connexionInsert->query("UPDATE `tbl_siniestro_pcls` SET `llaveCalificacion` = '$calificacionId' "
                                                                            . "WHERE (`idSiniestroPcl` = '$siniestroId')");
                                                                }

                                                                $suma = $suma + 1;
                                                            }
                                                        }
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

