<!DOCTYPE html>

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
    </head>
    <body style=" background-color: rgb(82, 86, 89);">

        <div class="col-7 row" style="margin-left: 20%;background-color: #fff;margin-top: 20px" >


            <div style="margin-left: 415px;margin-top: 40px">
                <img style="opacity: 0.6" src="/imagenes/imagenesCartas/pisitivaNegro.png"/>
            </div>
            <?php
            $now = new \DateTime();
            $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            ?>
            {!! Form::model($infoSiniestro, ['route'=>['CartaNegacion.update',$infoSiniestro->idSiniestroPcl], 'method'=>'put', 'onsubmit'=>'return Comprobar()'])  !!}

            <font  face="arial" style="font-size: 15px">
            <div style="margin-left: 50px;margin-right: 31px">
                <p>
                    <b>{{$infoSiniestro->codigoCorrespondencia}}</b><br>
                    Bogotá, DC. <?php echo $now->format('d') . ' de ' . $meses[$now->format('n') - 1] . ' de ' . $now->format('Y') ?><br>
                    <br>
                    <br>
                    <br>
                    Señor(a)<br>
                    <b>{{$infoSiniestro->nombre}}</b><br>
                    {{$infoSiniestro->tipo_documento}}: <b>{{$infoSiniestro->documento}}</b><br>
                    DIRECCION:<b>
                        @if($infoSiniestro->direccionResi != null)
                        {{$infoSiniestro->direccionResi}}
                        @else
                        <input name="direccionResi" required=""  class=" col-7 form-control form-control-sm ">
                        @endif
                    </b>
                    <br>
                    TELEFONO:<b>
                        @if($infoSiniestro->telefono != null)
                        {{$infoSiniestro->telefono}}
                        @else
                        <input name="telefono"  required=""  class=" col-7 form-control form-control-sm ">
                        @endif
                    </b>
                    <br>

                    CIUDAD:     
                        <b>
                            @if($infoSiniestro->ciudad != null)
                            {{$infoSiniestro->ciudad}}
                            @else
                            <div class="col-8 departa">
                                {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                <select class="form-control form-control-sm " required="" name="llaveDepartamento"  >
                                    <option value="">Seleccionar</option>
                                    @foreach  ($departamento as $department)
                                    <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            @endif
                            - 
                            @if($infoSiniestro->departamento != null)
                            {{$infoSiniestro->departamento}}
                            @else
                            <div class="col-8 ciuidadM">
                                {!! Form::label('txtDepartamento' , 'Ciudad') !!}
                                <select class="form-control form-control-sm ciuidadM" required="" name="llaveCiudad">                                          
                                </select>
                            </div>                               
                            @endif
                        </b>
                
                <br>
                <br>
                <b>Asunto: RESPUESTA SOLICITUD RECALIFICACIÓN PERDIDA DE CAPACIDAD LABORAL.</b><br>
                </p>
                <p align="justify">
                    Revisado su caso por el Equipo Interdisciplinario respecto de la nueva calificación médico laboral
                    por patologías reconocidas por Positiva Compañía de Seguros S.A. como secuelas de 
                    @if($infoSiniestro->tipo_evento == 'El' )<b> enfermedad laboral </b> @else <b>accidente de trabajo </b> 
                    @endif del <b>{{$infoSiniestro->fechaEvento}}</b> para los diagnósticos <b>@foreach  ($cie as $user)
                        {{$user -> id_ident}} {{$user -> cie_10}},
                        @endforeach</b>
                    .<br>
                    <br>
                    Que teniendo la calificación de Pérdida de Capacidad Laboral - PCL de <b>{{$infoSiniestro->porcentajePclRecalificacion}}%</b>, con número de
                    dictamen <b>{{$infoSiniestro->numeroDictamen}}</b> y fecha de <b>{{$infoSiniestro->fechaDictamenCalificacion}}</b> emitido por Junta Nacional, así como los soportes de
                    historias clínicas de su caso, no se demuestra carácter progresivo y se concluye que de acuerdo

                    con la legislación vigente (Ley 776 de 2002 – articulo 7), el <?php if ($infoSiniestro->tipo_evento == 'EL') { ?><b>enfermedad laboral  <?php } else { ?> </b> <b>accidente de trabajo <?php } ?></b>  mencionado no procede a 
                    recalificación de secuelas. <br>
                    <br>
                    Adjuntamos formato técnico científico con la explicación detallada. <br>
                    <br>
                    En caso de requerir cualquier información adicional, podrá comunicarse a través de línea
                    de  atención, marcando a nivel nacional 018000111170, o acercarse al punto de atención más
                    cercano.<br>
                    <br>
                    Cordialmente. <br>
                    <br>
                    <br>
                    <br>
                    <b>MEDICA ESPECIALISTA NIVEL CENTRAL</b><br>
                    <b>POSITIVA COMPAÑIA DE SEGUROS S.A</b><br>
                    <br>
                    Copia. Expediente.<br>
                    <br>
                    Proyectó y Elaboró: <b>{{$infoSiniestro->name}} – Médico laboral – Codess.</b><br>
                    Revisó: <b>Tatiana Escorcia - Coordinadora medicina laboral – Codess</b><br>
                    Anexo: <b> <input name="folio" id="folio" required=""  class=" col-7 form-control form-control-sm "> </b><br>
                    Forma de envío:<b> A</b><br>
                </p>
            </div>
            </font>
            <div style="margin-left: 110%;margin-top: -90px;position: absolute;" id="cartaMostar">
                <button type="submit" id="btnCarta" class="btn btn-app btn-outline-success color_texto"> <i class="fas fa-file-pdf"></i><b>Generar Pdf</b></button>
            </div>
            <input name="cc"  value="{{$infoSiniestro->documento}}" class=" col-7 form-control form-control-sm " hidden=""> 
            <input id="idSiniestro"  value="{{$infoSiniestro->idSiniestroPcl}}" class=" col-7 form-control form-control-sm " hidden=""> 
            <input name="IdRecalificacion"  value="{{$infoSiniestro->idRecalificacionPcls}}" class=" col-7 form-control form-control-sm " hidden=""> 
            <input name="idUsuarioCreador"  value="{{Auth::user()->id}}" class=" col-7 form-control form-control-sm " hidden=""> 
            <input name="idAfiliado"  value="{{$infoSiniestro->idAfiliado}}" class=" col-7 form-control form-control-sm " hidden=""> 

        </div>
        {!! Form::close() !!}
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
