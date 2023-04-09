<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Simel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="/date/css/bootstrap-datepicker.min.css"/>
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css"/>
        <link rel="stylesheet" href="/agenda/css/fullcalendar.css"/>
        <link rel="stylesheet" href="/style_personalizado/style.css"/>
        <style>

            #header { 
                width: 90%;
                margin-left: 5%;
                margin-top: 6%;

            }

            textarea:focus, input:focus, input[type]:focus {
                border-color: rgb(76, 175, 80 );
                box-shadow: 0 1px 1px rgba(76, 175, 80 , 0.075)inset, 0 0 8px rgba(76, 175, 80,0.6);
                outline: 0 none;
                background-color:#FFEBCD;
            }

            textarea {
                border-color: #DCEDC8;
                outline: 0 none;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 3px
            }

            input {
                border-color: #DCEDC8;
                outline: 0 none;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 5px
            }

        </style>
    <body style=" background-color: rgb(82, 86, 89);">
        <div class="col-10 row" style="margin-left:9%; background-color: #fff; width: 90%" >
            <br><br>
            <div id="header" >
                <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#545545" style="text-align: center; font-size: 14px; color:#515A5A; " >
                    <tbody>
                        <tr>
                            <td colspan="1" rowspan="4" width="15%" style="border: 1px solid #515A5A;" >   
                                <img style="opacity: 0.6;width: 100px; margin-left: 3px;margin-bottom: 3px;margin-right: 3px;margin-top: 3px"  src="/imagenes/imagenesCartas/positivaColor.png"/>
                            </td>
                            <td colspan="6" rowspan="3"  width="60%" style="border: 1px solid #515A5A;" > PROCESO: Gestión de Siniestros</td>
                            <td colspan="1" style="border: 1px solid #515A5A;" > Código:</td>
                            <td colspan="1" style="border: 1px solid #515A5A;" > MIS_5_4_2_FR33</td>
                        </tr>
                        <tr>
                            <td colspan="1" style="border: 1px solid #515A5A;" > Versión:</td>
                            <td colspan="1" style="border: 1px solid #515A5A;" > 1</td>
                        </tr>
                        <tr>
                            <td colspan="1" style="border: 1px solid #515A5A;" > Fecha:</td>
                            <td colspan="1" style="border: 1px solid #515A5A;" > 2016/07/01</td>
                        </tr>
                        <tr>
                            <td colspan="8" rowspan="1" style="border: 1px solid #515A5A;" > FORMATO <br>
                                <b>NEGACIÓN A SOLICITUD DE RECALIFICACIÓN PERDIDAD DE CAPACIDAD LABORAL</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;"  > <b>Aprobó:</b><br>
                                German Javier Fernández Ricardo<br>
                                Gerente Médico
                            </td>
                            <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;" > <b>Revisó: </b><br>
                                Silvia Alejandra Cruz Lizcano<br>
                                Líder SIG
                            </td>
                            <td colspan="3" rowspan="1" style="border: 1px solid #515A5A;" > <b>Elaboró: </b><br>
                                Carolina Cuervo Gasca<br>
                                Médico Especialista Nivel Central
                            </td>
                        </tr>
                    </tbody>
                </table>      
            </div>
            <div id="content" style="width: 90%; margin-left: 5%;" >
                  <?php
        $now = new \DateTime();
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        ?>
                {!! Form::model($infoSiniestro, ['route'=>['FormatoNegacionAdicion.update',$infoSiniestro->idAdicionPcl], 'method'=>'put', 'onsubmit'=>'return Comprobar3()'])  !!}
                <br>
                <h5 style="margin-left: 45px;" ><i>INFORMACION GENERAL DE LA ENTIDAD CALIFICADORA</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 10px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td colspan="4" style="border: 2px solid #000;" >&nbsp; NOMBRE ENTIDAD ADMINISTRADORA</td>
                            <td colspan="4" style="border: 2px solid #000;" >&nbsp;  POSITIVA COMPAÑÍA DE SEGUROS</td>
                        </tr>
                        <tr>                      
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; DIRECCION</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; AVDA CRA 45 No 94-83</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; TELEFONO</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; 6502200</td>
                        </tr>
                        <tr>                      
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; CIUDAD</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; BOGOTA</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; FECHA:</td>
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp; <?php echo $now->format('d') . ' de ' . $meses[$now->format('n')- 1] . ' de ' . $now->format('Y') ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 45px"><i>DICTAMEN MOTIVO DE ANALISIS</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: center;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td style="border: 2px solid #000;" >&nbsp;  ENTIDAD CALIFICADORA</td>
                            <td style="border: 2px solid #000;" >&nbsp;  NUMERO DE DICTAMEN</td>
                            <td style="border: 2px solid #000;" >&nbsp;  FECHA DEL DICTAMEN</td>
                            <td style="border: 2px solid #000;" >&nbsp;  DIAGNOSTICO</td>
                            <td style="border: 2px solid #000;" >&nbsp;  PERDIDA DE CAPACIDAD LABORAL</td>
                        </tr>
                        <tr>          
                            <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->entidadCalificaPcl}}</td>
                            <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->numeroDictamen}}</td>
                            <td style="border: 2px solid #000;" >&nbsp;  {{$infoSiniestro->fechaDictamenCalificacion}}</td>
                            <td style="border: 2px solid #000;" >&nbsp;  @foreach  ($cie as $user)
                                {{$user -> id_ident}} {{$user -> cie_10}},
                                @endforeach</td>
                            <td style="border: 2px solid #000;" > {{$infoSiniestro->porcentajePclRecalificacion}}%</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 45px"><i>DATOS PERSONALES DEL CALIFICADO</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td colspan="2" style="border: 2px solid #000;" >&nbsp;APELLIDOS</td>
                            <td colspan="9" style="border: 2px solid #000;" >&nbsp;{{$infoSiniestro->nombre}}</td>
                        </tr>
                        <tr>          
                            <td colspan="2" Style="border: 2px solid #000;" >&nbsp;NOMBRES</td>
                            <td colspan="9" style="border: 2px solid #000;">&nbsp;{{$infoSiniestro->nombre}}</td>
                        </tr>
                        <tr>          
                            <td colspan="2"  style="border: 2px solid #000;" >&nbsp;DOC.  IDENTIDAD</td>
                            <td colspan="5"  style="border: 2px solid #000;" >&nbsp;{{$infoSiniestro->documento}}</td>
                            <td colspan="4"  style="border: 2px solid #000;" >&nbsp;</td>
                        </tr>
                        <tr>          
                            <td colspan="2"  style="border: 2px solid #000;" >&nbsp;FECHA NTO.</td>
                            <td colspan="5"  style="border: 2px solid #000;" ><div class="form-group">
                                    <div class="input-group date">
                                        <input id="TxtFecha" type="text" class="col-11 form-control form-control-sm" placeholder="FECHA NTO." name="fechaNacimiento" required="">
                                        <div class="input-group-append"></div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2"  style="border: 2px solid #000;" >&nbsp;EDAD</td>
                            <td colspan="2"  style="border: 2px solid #000; " >&nbsp;
                            </td>
                        </tr>
                        <tr>          
                            <td  colspan="2" style="border: 2px solid #000;" >&nbsp;GENERO</td>
                            <td  colspan="9" style="border: 2px solid #000;" ><input  id="TxtGenero" required="" name="Genero" placeholder="GENERO"  class=" col-7 form-control form-control-sm " ></td>
                        </tr>
                        <tr>          
                            <td style="border: 2px solid #000;">&nbsp;ESTADO CIVIL</td>
                            <td style="border: 2px solid #000;">&nbsp;SOLTERO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="estadoCivil" value="1" id="radio1" /></td>
                            <td style="border: 2px solid #000;">&nbsp;CASADO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="estadoCivil" value="2" id="radio2" /></td>
                            <td style="border: 2px solid #000;">&nbsp;VIUDO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="estadoCivil" value="3" id="radio3" /></td>
                            <td style="border: 2px solid #000;">&nbsp;U.L </td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="estadoCivil" value="4" id="radio4" /></td>
                            <td style="border: 2px solid #000;">&nbsp;SEPARADO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="estadoCivil" value="5" id="radio5" /></td>
                        </tr>
                        <tr>          
                            <td style="border: 2px solid #000;">&nbsp;ESCOLARIDAD</td>
                            <td style="border: 2px solid #000;">&nbsp;PRIMARIA</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="escolaridad" value="1" id="radio6" /></td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;SECUND</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="escolaridad" value="2" id="radio7" /></td>
                            <td style="border: 2px solid #000;">&nbsp;TECNICO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required=""  type="radio" name="escolaridad" value="3" id="radio8" /></td>
                            <td style="border: 2px solid #000;">&nbsp;UNIVERSITA </td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="escolaridad" value="4" id="radio9" /></td>
                            <td style="border: 2px solid #000;">&nbsp;OTRO</td>
                            <td style="border: 2px solid #000;" width="3%" >&nbsp;<input required="" type="radio" name="escolaridad" value="5" id="radio0" /></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 45px"><i>ANTECEDENTES LABORALES</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td style="border: 2px solid #000;" >&nbsp;NOMBRE EMPRESA </td>
                            <td style="border: 2px solid #000;" ><input id="TxtNombreEmpresa" required="" name="TxtNombreEmpresa" placeholder="NOMBRE EMPRESA" class=" col-11 form-control form-control-sm "></td>
                        </tr>
                        <tr>    
                            <td Style="border: 2px solid #000;" >&nbsp;CARGO ACTUAL</td>
                            <td style="border: 2px solid #000;"><input id="TxtCargo" required="" name="TxtCargo" placeholder="CARGO ACTUAL"  class=" col-11 form-control form-control-sm "></td>
                        </tr>
                        <tr>  
                            <td Style="border: 2px solid #000;" >&nbsp;ANTIGÜEDAD EN LA <br>&nbsp;EMPRESA</td>
                            <td style="border: 2px solid #000;"><input id="TxtAntiguedadEmpresa" required="" name="TxtAntiguedadEmpresa" placeholder="ANTIGÜEDAD EN LA EMPRESA"  class=" col-11 form-control form-control-sm "></td>
                        </tr>                       
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 45px"><i>FUNDAMENTOS DE LA SOLICITUD</i></h5>
                <br>
                <h5 style="margin-left: 45px"><i>RELACION DOCUMENTOS</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td style="border: 2px solid #000;" >&nbsp;DOCUMENTO </td>
                            <td Style="border: 2px solid #000;" >&nbsp;DESCRIPCION</td>
                        </tr>
                        <tr>    
                            <td Style="border: 2px solid #000;" >&nbsp;HISTORIA CLINICA</td>
                            <td style="border: 2px solid #000;"><textarea id="TxtHistoriaClinica" required="" name="TxtHistoriaClinica" placeholder="HISTORIA CLINICA" class="col-11 form-control form-control-sm " rows="3" style="width: 100%"></textarea></td>
                        </tr>
                        <tr>  
                            <td Style="border: 2px solid #000;" >&nbsp;ESTUDIOS</td>
                            <td style="border: 2px solid #000;"><textarea id="TxtEstudios" required="" name="TxtEstudios" placeholder="ESTUDIOS" class="col-11 form-control form-control-sm " rows="3" style="width: 100%"></textarea></td>
                        </tr>                       
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 40px; "><i>RESUMEN CLINICO Y JUSTIFICACION DE LA NO PERTINENCIA DERECALIFICACION</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td style="border: 2px solid #000;" ><textarea id="TxtResumen" required="" name="TxtResumen" placeholder="RESUMEN CLINICO Y JUSTIFICACION DE LA NO PERTINENCIA DERECALIFICACION" class="col-11 form-control form-control-sm " rows="15" style="width: 100%"></textarea></td>
                        </tr>                                      
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 40px; "><i>DIAGNOSTICO</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td Style="border: 2px solid #000;" >&nbsp;@foreach  ($cie as $user)
                                {{$user -> id_ident}},
                                @endforeach
                            </td>
                            <td style="border: 2px solid #000;">&nbsp;@foreach  ($cie as $user)
                                {{$user -> id_ident}} {{$user -> cie_10}},
                                @endforeach
                            </td>
                        </tr>                                      
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 40px; "><i>EXAMENES E INTERCONSULTAS PERTINENTES</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td Style="border: 2px solid #000;" width="5%"  >&nbsp;ID</td>
                            <td Style="border: 2px solid #000;" width="10%" >&nbsp;TIPO EXAMEN INTERCONSULTA </td>
                            <td Style="border: 2px solid #000;" >&nbsp;ULTIMO RESULTADO</td>
                        </tr>      
                        <tr>                      
                            <td Style="border: 2px solid #000;" ><textarea id="TxtId" required="" name="TxtId" placeholder="ID" class="col-11 form-control form-control-sm " rows="15" style="width: 100%"></textarea></td>
                            <td Style="border: 2px solid #000;" ><textarea id="TxtTipoExamen" required="" name="TxtTipoExamen" placeholder="ESTUDTIPO EXAMEN INTERCONSULTAIOS" class="col-11 form-control form-control-sm " rows="15" style="width: 100%"></textarea></td>
                            <td Style="border: 2px solid #000;" ><textarea id="TxtultimoResultado" required="" name="TxtultimoResultado" placeholder="ULTIMO RESULTADO" class="col-11 form-control form-control-sm " rows="15" style="width: 100%"></textarea></td>
                        </tr>   
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 40px; "><i>CONCLUSION</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td Style="border: 2px solid #000;" ><textarea id="TxtConclusion" required="" name="TxtConclusion" placeholder="CONCLUSION" class="col-11 form-control form-control-sm " rows="15" style="width: 100%"></textarea></tr>                                      
                    </tbody>
                </table>
                <br>
                <h5 style="margin-left: 40px; "><i>RESPONSABLES DE LA RECALIFICACION</i></h5>
                <table border="1" cellpadding="0" cellspacing="0" width="94%" bordercolor="#545545" style="margin-left: 30px; margin-top: 7px;text-align: left;font-size: 14px; color:#000; 1px solid #000;" >
                    <tbody>
                        <tr>                      
                            <td Style="border: 2px solid #000;" width="10%" >&nbsp;MEDICO LABORAL</td>
                            <td Style="border: 2px solid #000;" ><input  readonly="" required="" value="{{$infoSiniestro->name}}" placeholder="MEDICO LABORAL" name="TxtMedico" class="col-11 form-control form-control-sm"></td>          
                        </tr>  
                        <?php $now = new \DateTime(); ?> 
                        <tr>                      
                            <td Style="border: 2px solid #000;" width="10%" >&nbsp;RM 3227  LSO 789</td>
                            <td Style="border: 2px solid #000;" ><input required="" readonly="" value="<?php echo $now->format('Y-m-d'); ?>" placeholder="RM 3227  LSO 789" name="TxtRm" class=" col-11 form-control form-control-sm"></td>          
                        </tr>  
                    </tbody>
                </table>
                <div style="margin-left:-15%;margin-top: -90px;position: absolute;" id="bottonFormato">
                    <button type="submit" id="btnFormato" class="btn btn-app btn-outline-success color_texto"> <i class="fas fa-file-pdf"></i><b>Generar Pdf</b></button>
                </div>
                <input name="cc"  value="{{$infoSiniestro->documento}}" class=" col-7 form-control form-control-sm " hidden=""> 
                <input id="idSiniestro"  value="{{$infoSiniestro->idAdicionPcl}}" class=" col-7 form-control form-control-sm " hidden=""> 
                <input name="IdRecalificacion"  value="{{$infoSiniestro->idRecalificacionPcls}}" class=" col-7 form-control form-control-sm " hidden=""> 
                <input name="idUsuarioCreador"  value="{{Auth::user()->id}}" class=" col-7 form-control form-control-sm " hidden=""> 
                <input name="idAfiliado"  value="{{$infoSiniestro->idAfiliado}}" class=" col-7 form-control form-control-sm " hidden=""> 

                {!! Form::close() !!}
            </div>
        </div>
    </body>
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/dist/js/empresaForm.js" type="text/javascript"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <script src="/plugins/sparklines/sparkline.js"></script>
    <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/dist/js/adminlte.js"></script>
    <script src="/dist/js/pages/dashboard.js"></script>
    <script src="/dist/js/demo.js"></script>
    <script src="/date/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/date/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
    <script src="/style_personalizado/fecha.js" type="text/javascript"></script>
    <script src="/style_personalizado/funcionesGerenal.js" type="text/javascript"></script>
    <script src="/js_personalizado/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/js_personalizado/funcion_dx.js" type="text/javascript"></script>
    <script src="/dist/js/funsionInsertCie10.js" type="text/javascript"></script>
    <script src="/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!--========================================Agenda  ===================================================-->
    <script src="/agenda/js/moment.min.js" type="text/javascript"></script>
    <script src="/agenda/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="/agenda/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
    <script src="/agenda/js/fullcalendar/locale/es.js" type="text/javascript"></script>
    <script src="/dist/js/validaciones.js" type="text/javascript"></script>
    <script src="/js_personalizado/funcionTablaCargue.js" type="text/javascript"></script>
    <script src="/dist/js/toastFunsiones.js" type="text/javascript"></script>
    <script src="/dist/js/permisos.js" type="text/javascript"></script>
    <script src="/dist/js/permisosAdicion.js" type="text/javascript"></script>
    <script src="/js_personalizado/funcionMiBandeja.js" type="text/javascript"></script>

</html>