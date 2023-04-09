<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Carta negacion</title>
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
    <body>

        <div style="margin-left: 415px;margin-top: 26px">
            <img style="opacity: 0.6" src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/imagenes/imagenesCartas/pisitivaNegro.png'; ?>"/>
        </div>
        <?php
        $now = new \DateTime();
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        ?>
        {!! Form::model($infoSiniestro, ['route'=>['CartaNegacionAdicion.update',$infoSiniestro->idAdicionPcl], 'method'=>'put'])  !!}

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
                DIRECCION: <b>
                    @if($infoSiniestro->direccionResi != null)
                    {{$infoSiniestro->direccionResi}}
                    @else
                    {{$direccionResi}}                      
                    @endif
                </b><br>
                TELEFONO:<b>
                    @if($infoSiniestro->telefono != null)
                    {{$infoSiniestro->telefono}}
                    @else
                    {{$telefono}}                      
                    @endif

                </b><br>

                CIUDAD:<b>
                    @if($infoSiniestro->ciudad != null)
                    {{$infoSiniestro->ciudad}}
                    @else
                    <!--/*=============Consulta Ciudad=====================*/-->
                    @php
                    $ciudades = DB::table('tbl_ciudad')
                    ->where('id_ciudad','=',$llaveCiudad)
                    ->get() ;

                    @endphp

                    @foreach($ciudades  as $key => $ciudad)
                    {{$ciudad->ciudad}}
                    @endforeach
                    <!--/*==================================*/-->
                    @endif
                    - 
                    @if($infoSiniestro->departamento != null)
                    {{$infoSiniestro->departamento}}
                    @else
                    <!--/*=============Consulta departamento=====================*/-->
                    @php
                    $depatamentos = DB::table('tbl_departamento')
                    ->where('id_departamento','=',$llaveDepartamento)
                    ->get() ;

                    @endphp

                    @foreach($depatamentos  as $key => $departamento)
                    {{$departamento->departamento}}
                    @endforeach
                    <!--/*==================================*/-->
                    @endif
                </b><br><br>


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
                dictamen <b>{{$infoSiniestro->numeroDictamen}}</b> y fecha de <b>{{$infoSiniestro->fechaDictamenCalificacion}}</b> emitido por <b>{{$infoSiniestro->entidadCalificaPcl}}</b>, así como los soportes de
                historias clínicas de su caso, no se demuestra carácter progresivo y se concluye que de acuerdo

                con la legislación vigente (Ley 776 de 2002 – articulo 7), el <?php if ($infoSiniestro->tipo_evento == 'EL') { ?><b>enfermedad laboral  <?php } else { ?> </b> <b>accidente de trabajo <?php } ?></b>   mencionado no procede a 
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
                Revisó: -  <b>Tatiana Escorcia - Coordinadora medicina laboral – Codess</b><br>
                Anexo: <b>{{$folio}}</b><br>
                Forma de envío:<b> A</b><br>
            </p>
        </div>
        </font>
        {!! Form::close() !!}
    </body>
</html>
