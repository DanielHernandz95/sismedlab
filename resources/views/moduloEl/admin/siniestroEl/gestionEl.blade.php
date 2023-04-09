@extends('/plantilla.templateEl')
@section('tatle','app')

@section('formulario')
<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#datosBasicos" data-toggle="tab">Datos Básicos</a></li>
                            <li class="nav-item"><a class="nav-link" href="#diagnosticos" data-toggle="tab">Diagnósticos</a></li>
                            @if($infoSiniestroEl->llavePrecalificacionEl != NULL)
                            <li class="nav-item"><a class="nav-link" href="#preCalificacion" data-toggle="tab">PreCalificación</a></li>
                            @endif

                            @if($infoSiniestroEl->llaveCalificacionEl != NULL)
                            <li class="nav-item"><a class="nav-link" href="#calificacion" data-toggle="tab">Calificación</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="#historial" data-toggle="tab">Historial</a></li>
                        </ul>
                    </div>
                    <div class="" style="background-color: #fff; ">
                        <div class="tab-content">
                            <div class="tab-pane active" id="datosBasicos">
                                {!! Form::model($infoSiniestroEl, ['route'=>['Siniestro_El.update',$infoSiniestroEl->id_elSiniestro], 'method'=>'put'])  !!}
                                <br>
                                <div id="" >
                                    <section class="content col-12" >
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Ingrese los detalles del siniestro</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-3 valorEntrada" >
                                                            {!! Form::label('llaveCanlaEntradaEl' , 'Canal entrada') !!}
                                                            <select class="form-control form-control-sm "  name="llaveCanlaEntradaEl" required="" id="canalEntradaEl">
                                                                <option value="{{$infoSiniestroEl -> id_entrada}}">{{$infoSiniestroEl -> entrada}}</option>
                                                                @foreach  ($entradaPclEl as $entrada)
                                                                <option value="{{$entrada -> id_entrada}}">{{$entrada -> entrada}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-5 " id="">
                                                            {!! Form::label('llaveTipoSolicitudEl' , 'Tipo de solicitud') !!}
                                                            <select class="form-control form-control-sm"  name="llaveTipoSolicitudEl" required="" id="">
                                                                <option value="{{$infoSiniestroEl -> id_solicitud}}">{{$infoSiniestroEl -> solicitud}}</option>
                                                                @foreach  ($tipoSolicitudEl as $tipoSoli)
                                                                <option value="{{$tipoSoli -> id_solicitud}}">{{$tipoSoli -> solicitud}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            {!! Form::label('llaveCovid' , 'Marcacion COVID') !!}
                                                            <select class="form-control form-control-sm "  name="llaveCovid" required="">
                                                                <option value="{{$infoSiniestroEl -> idCovid}}">{{$infoSiniestroEl -> covid}}</option>
                                                                @foreach  ($covid as $cov)
                                                                <option value="{{$cov -> idCovid}}">{{$cov -> covid}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3 date">
                                                            {!! Form::label('fechaRadicadoArlPositiva' , 'Fecha radicacion a ARL positiva') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaRadicadoArlPositiva',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha radicacion a ARL positiva', 'required'=>""]) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <div class="col-3">
                                                            {!! Form::label('llaveCobertura' , 'Cobertura') !!}
                                                            <select class="form-control form-control-sm "  name="llaveCobertura" required="" id="txtCobertura">
                                                                <option value="{{$clfEl -> idCobertura}}">{{$clfEl -> cobertura}}</option>
                                                                @foreach  ($cobertura as $cober)
                                                                <option value="{{$cober -> idCobertura}}">{{$cober -> cobertura}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3" id="DivraSaEnCarCobeODevoEPs">
                                                            {!! Form::label('raSalidaCoBerturaDevolucionEps' , 'Radicado cobertura o dev. eps') !!}
                                                            {!! Form::text('raSalidaCoBerturaDevolucionEps',null,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Radicado salida envió carta cobertura o devolución eps','id'=>"TxtraSaEnCarCobeODevoEPs"]) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div> 
                                                        <div class="col-3">
                                                            {!! Form::label('llaveRevicionCobertura' , 'Revision cobertura') !!}
                                                            <select class="form-control form-control-sm "  name="llaveRevicionCobertura" required="">
                                                                <option value="{{$clfEl -> idRevisionCobertura}}">{{$clfEl -> revisionCobertura}}</option>
                                                                @foreach  ($revicionCoberturas as $revicionCob)
                                                                <option value="{{$revicionCob -> idRevisionCobertura}}">{{$revicionCob -> revisionCobertura}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!--                                                        <div class="col-3 date">
                                                                                                                    {!! Form::label('fechaAsignacionPqr' , 'Fecha asignacion PQR') !!}
                                                                                                                    <div class="input-group date">
                                                                                                                        {!! Form::text('fechaAsignacionPqr',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignacion PQR', 'required'=>""]) !!}
                                                                                                                        <div class="input-group-append">
                                                                                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                                                                        </div>
                                                                                                                    </div> 
                                                                                                                </div>-->
                                                        <div class="col-3 ">
                                                            {!! Form::label('numeroRadicadoEntrada' , 'Numero radicado entrada') !!}
                                                            <div class="input-group ">
                                                                {!! Form::text('numeroRadicadoEntrada',null,['class' => 'form-control form-control-sm','placeholder' => 'Numero radicado entrada', 'required'=>""]) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-3 departaSiniestro">
                                                            {!! Form::label('llaveDepartramentoEl' , 'Departamento') !!}
                                                            <select class="form-control form-control-sm "  name="llaveDepartramentoEl">
                                                                <option value="{{$infoSiniestroEl -> id_departamento}}">{{$infoSiniestroEl -> departamento}}</option>
                                                                @foreach  ($departamento as $department)
                                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {!! Form::text('llaveCiudadEl',null,['class' => 'form-control form-control-sm permisosInput ','id'=>'ciuidadEditEl','hidden'=>'']) !!}
                                                        <div class="col-3 ciuidadMSiniestro">
                                                            {!! Form::label('TxtCiudadSiniestro' , 'Ciudad') !!}
                                                            <select class="form-control form-control-sm "  name="llaveCiudadEl"  id="">                                          
                                                            </select>
                                                        </div>
                                                        <div class="col-3 date">
                                                            {!! Form::label('fechaEnfermedad' , 'Fecha enfermedad') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaEnfermedad',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad', 'required'=>""]) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <div class="col-3">
                                                            {!! Form::label('numeroSiniestro' , 'Numero siniestro') !!}
                                                            {!! Form::text('numeroSiniestro',null,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Numero siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()','required'=>""]) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div>                                          

                                                        {!! Form::text('TxtUsuarioQuienCrea',Auth::user()->id,['class' => 'form-control form-control-sm ', 'hidden'=>'']) !!}
                                                        {!! Form::text('TxtllaveCalificacion',$infoSiniestroEl->llaveCalificacionEl,['class' => 'form-control form-control-sm ', 'hidden'=>'']) !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--==================================================Datos Eps==================================================-->
                                    <section class="content col-12">
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Información EPS</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5" >
                                                            {!! Form::label('TxtEps' , 'EPS') !!}
                                                            <select class="form-control form-control-sm " name="llaveEpsEl" id="idEps" onchange="eps()"  >
                                                                @if($infoSiniestroEl->llaveEpsEl != null)
                                                                <option value="{{$epsMostar -> id_eps}}">{{$epsMostar -> eps}}</option>
                                                                @foreach  ($eps as $e)
                                                                <option value="{{$e -> id_eps}}">{{$e -> eps}}</option>
                                                                @endforeach
                                                                @else
                                                                <option value="">Seleccionar</option>
                                                                @foreach  ($epsSinInfo as $e)
                                                                <option value="{{$e -> id_eps}}">{{$e -> eps}}</option>
                                                                @endforeach
                                                                @endif



                                                            </select>
                                                        </div> 
                                                        <div class="col-2">
                                                            <label>Folio</label>
                                                            <input  type="text"  name="folioEl"  value="{{$epsMostar -> folioEl}}" class="form-control form-control-sm" placeholder="Folio">
                                                        </div>
                                                        <div class="row col-12" id="epsExiste"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!--==================================================Datos basicos empresa==================================================-->
                                    {!! Form::text('llaveUnionCasosCuida',null,['class' => 'form-control form-control-sm ','id'=>'cuidadUnoDato', 'hidden'=>'']) !!}

                                    <section class="content col-12" id="cuidaUnoEdit" style="display: none">
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Asignación casos cuida 1</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            {!! Form::label('noApli' , 'Responsable') !!}
                                                            {!! Form::text('noApli',$cuidaUnoInfo->name,['class' => 'form-control form-control-sm solo_numero' ,'readonly'=>'']) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div> 
                                                        <div class="col-3 date">
                                                            {!! Form::label('fechaRevicion' , 'Fecha revision') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaRevicion',$cuidaUnoInfo->fechaRevicion,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad','readonly'=>'']) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveAfiliacion' , 'Afiliacion') !!}
                                                            <select class="form-control form-control-sm "  name="llaveAfiliacion" id="TxtAfiliacion">
                                                                <option value="{{$cuidaUnoInfo -> idAfiliacion}}">{{$cuidaUnoInfo -> afiliacion}}</option>
                                                                @foreach  ($afiliado as $afili)
                                                                <option value="{{$afili->idAfiliacion}}">{{$afili->afiliacion}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveCreado' , 'Creado') !!}
                                                            <select class="form-control form-control-sm "  name="llaveCreado" id="TxtCreado" >
                                                                <option value="{{$cuidaUnoInfo -> idCreado}}">{{$cuidaUnoInfo -> creado}}</option>
                                                                @foreach  ($creado as $creado)
                                                                <option value="{{$creado->idCreado}}">{{$creado->creado}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3 date">
                                                            {!! Form::label('fechaCreacion' , 'Fecha creación ') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaCreacion',$cuidaUnoInfo->fechaCreacion,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad', 'id'=>'TxtFechaCreacion']) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveEstadoInicial' , 'Estado inicial') !!}
                                                            <select class="form-control form-control-sm "  name="llaveEstadoInicial"  id="TxtEstadoInicial">
                                                                <option value="{{$cuidaUnoInfo -> iDinicial}}">{{$cuidaUnoInfo -> inicial}}</option>
                                                                @foreach  ($estadoIniciail as $estadoIniciail)
                                                                <option value="{{$estadoIniciail->id_estado_siniestro}}">{{$estadoIniciail->estado_siniestro}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveGestionRealizada' , 'Gestión a realizar') !!}
                                                            <select class="form-control form-control-sm "  name="llaveGestionRealizada"  id="TxtGestionRealizar">
                                                                <option value="{{$cuidaUnoInfo -> idGestionRealizar}}">{{$cuidaUnoInfo -> gestionArealizar}}</option>
                                                                @foreach  ($gestionRealizar as $gestionRea)
                                                                <option value="{{$gestionRea->idGestionRealizar}}">{{$gestionRea->gestionArealizar}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveEstadoTramite' , 'Estado tramite') !!}
                                                            <select class="form-control form-control-sm "  name="llaveEstadoTramite" id="TxtEstadoTramite">
                                                                <option value="{{$cuidaUnoInfo -> iDtrami}}">{{$cuidaUnoInfo -> tramite}}</option>
                                                                @foreach  ($estadoTramite as $estadoTramite)
                                                                <option value="{{$estadoTramite->id_estado_siniestro}}">{{$estadoTramite->estado_siniestro}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">                                   
                                                            {!! Form::label('llaveEstadoFinal' , 'Estado final') !!}
                                                            <select class="form-control form-control-sm "  name="llaveEstadoFinal" id="TxtEstadoFinal">
                                                                <option value="{{$cuidaUnoInfo -> iDfin}}">{{$cuidaUnoInfo -> final}}</option>
                                                                @foreach  ($estadoFinal as $estadoFinal)
                                                                <option value="{{$estadoFinal->id_estado_siniestro}}">{{$estadoFinal->estado_siniestro}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12" style="margin-top: 1%">
                                                            <label>Observaciones</label>
                                                            <textarea  class="form-control"  rows="3" name="TxtAnalisisCaso" placeholder="Observaciones ..."></textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!--==================================================Datos basicos empresa==================================================-->
                                    <section class="content col-12" id="formularioBasicoAfiliado">
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Datos basicos afiliado</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">                                   
                                                            {!! Form::label('tipo_documento' , 'Tipo Documento') !!}
                                                            <select class="form-control form-control-sm "  name="llaveTipoDocumento" id="permisosTiDocumento">
                                                                <option value="{{$infoSiniestroEl->id_tipo_docuemtno}}">{{$infoSiniestroEl->tipo_documento}}</option>
                                                                @foreach  ($tipoDocumentoAfiliado as $tipoDocumenAfi)
                                                                <option value="{{$tipoDocumenAfi -> id_tipo_docuemtno}}">{{$tipoDocumenAfi -> tipo_documento}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {!! Form::text('idAfiliado',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Numero Documento','hidden'=>'']) !!}

                                                        <div class="col-2">
                                                            {!! Form::label('documento' , 'Numero Documento') !!}
                                                            {!! Form::text('documento',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Numero Documento',  'id'=>'permisosDocumento']) !!}
                                                        </div>
                                                        <div class="col-3">
                                                            {!! Form::label('nombre' , 'Nombre') !!}
                                                            {!! Form::text('nombre',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Nombre' , 'id'=>'permisosNombre']) !!}
                                                        </div>
                                                        <div class="col-3 departa">
                                                            {!! Form::label('llaveGenero' , 'Genero') !!}
                                                            <select class="form-control form-control-sm "  name="llaveGenero">
                                                                <option value="{{$infoSiniestroEl->idGenero}}">{{$infoSiniestroEl->genero}}</option>
                                                                @foreach  ($genero as $gen)
                                                                <option value="{{$gen -> idGenero}}">{{$gen -> genero}}</opti                                                                on>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3 date">
                                                            {!! Form::label('fechaNacimiento' , 'Fecha nacimiento') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaNacimiento',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha nacimiento', 'id'=>'TxtFechaCreacion']) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <?php
                                                        $idsini = $infoSiniestroEl->fechaNacimiento;
                                                        $cumpleanos = new \DateTime($idsini);
                                                        $hoy = new \DateTime();
                                                        $annos = $hoy->diff($cumpleanos);
                                                        $edad = ($annos->y);
                                                        ?>

                                                        <div class="col-3">
                                                            {!! Form::label('$edad' , 'Edad') !!}
                                                            <input class="form-control form-control-sm UpperCase" value="{{$edad}}" readonly="">
                                                        </div>

                                                        <div class="col-2">
                                                            {!! Form::label('direccionResi' , 'Direccion') !!}
                                                            {!! Form::text('direccionResi',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Direccion', 'id'=>'permisosDireccion']) !!}
                                                        </div>
                                                        <div class="col-2 departa" >
                                                            {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                                            <select class="form-control form-control-sm "  name="llaveDepartamento" id="">
                                                                <option value="{{$residenciaAdfilidos->id_departamento}}">{{$residenciaAdfilidos->departamento}}</option>
                                                                @foreach  ($departamentoAdiliado as $department)
                                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {!! Form::text('llaveCiudad',null,['class' => 'form-control form-control-sm permisosInput ','hidden'=>'','id'=>'ciuidadEditAfiliado']) !!}
                                                        <div class="col-2 ciuidadM">
                                                            {!! Form::label('txtDepartamento' , 'Ciudad') !!}
                                                            <select class="form-control form-control-sm  "  name="llaveCiudad" required="" id="">                                          
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            {!! Form::label('telefono' , 'Telefono fijo') !!}
                                                            {!! Form::text('telefono',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Telefono fijo', 'id'=>'permisosTelefono']) !!}
                                                        </div>
                                                        <div class="col-2">
                                                            {!! Form::label('celular' , 'Numero celular') !!}
                                                            {!! Form::text('celular',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Numero celular', 'id'=>'permisosCelular']) !!}
                                                        </div>
                                                        <div class="col-3">
                                                            {!! Form::label('Correo' , 'Correo') !!}
                                                            {!! Form::text('Correo',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Correo', 'id'=>'permisosCorreo']) !!}
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--==================================================Datos basicos empresa==================================================-->
                                    <section class="content col-12">
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Datos basicos empresa</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2 ">
                                                            <label>Nit empleador</label>
                                                            {!! Form::text('nit',null,['class' => 'form-control form-control-sm permisosInput idSiniestroGestion','placeholder' => 'Nit empleador', 'id' => 'idEmpleador' ]) !!}
                                                        </div> 
                                                        <!--=====================Campos Empresa Cargados=================================-->
                                                        <div class="row col-12" id="empresaSiExiste"></div>
                                                        <div class="row col-12" id="empresasMasPorNit"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="bottonDatosBasicosSiniestro">
                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                        </div> 
                                    </div>
                                </div>

                                <!--./================================================== detalles del siniestro =================================================-->
                                {!! Form::text('llaveCanlaEntradaElA',$infoSiniestroEl->llaveCanlaEntradaEl,['hidden'=>'']) !!}
                                {!! Form::text('llaveTipoSolicitudElA',$infoSiniestroEl->llaveTipoSolicitudEl,['hidden'=>'']) !!}
                                {!! Form::text('llaveCovidA',$infoSiniestroEl->llaveCovid,['hidden'=>'']) !!}
                                {!! Form::text('fechaRadicadoArlPositivaA',$infoSiniestroEl->fechaRadicadoArlPositiva,['hidden'=>'']) !!}
                                {!! Form::text('fechaAsignacionPqrA',$infoSiniestroEl->fechaAsignacionPqr,['hidden'=>'']) !!}
                                {!! Form::text('numeroRadicadoEntradaA',$infoSiniestroEl->numeroRadicadoEntrada,['hidden'=>'']) !!}
                                {!! Form::text('llaveDepartramentoElA',$infoSiniestroEl->llaveDepartramentoEl,['hidden'=>'']) !!}
                                {!! Form::text('llaveCiudadElA',$infoSiniestroEl->llaveCiudadEl,['hidden'=>'']) !!}
                                {!! Form::text('numeroSiniestroA',$infoSiniestroEl->numeroSiniestro,['hidden'=>'']) !!}
                                {!! Form::text('llaveEmpresaElA',$infoSiniestroEl->llaveEmpresaEl,['hidden'=>'']) !!}
                                {!! Form::text('fechaEnfermedadA',$infoSiniestroEl->fechaEnfermedad,['hidden'=>'']) !!}
                                {!! Form::text('llaveCoberturaA',$infoSiniestroEl->llaveCobertura,['hidden'=>'']) !!}
                                {!! Form::text('llaveRevicionCoberturaA',$infoSiniestroEl->llaveRevicionCobertura,['hidden'=>'']) !!}
                                {!! Form::text('raSalidaCoverturaDevolucionEpsA',$infoSiniestroEl->raSalidaCoverturaDevolucionEps,['hidden'=>'']) !!}
                                {!! Form::text('definicionOrigenPrimeraOportunidadEpsA',$infoSiniestroEl->definicionOrigenPrimeraOportunidadEps,['hidden'=>'']) !!}
                                {!! Form::text('definicionOrigenPrimeraOportunidadPositivaA',$infoSiniestroEl->definicionOrigenPrimeraOportunidadPositiva,['hidden'=>'']) !!}
                                {!! Form::text('llaveEpsElA',$infoSiniestroEl->llaveEpsEl,['hidden'=>'']) !!}
                                {!! Form::text('folioElA',$infoSiniestroEl->folioEl,['hidden'=>'']) !!}
                                <!--./================================================== detalles del Cuida uno =================================================-->


                                {!! Form::text('fechaRevicionA',$cuidaUnoInfo->fechaRevicion,['hidden'=>'']) !!}
                                {!! Form::text('llaveAfiliacionA',$cuidaUnoInfo->llaveAfiliacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveCreadoA',$cuidaUnoInfo->llaveCreado,['hidden'=>'']) !!}
                                {!! Form::text('fechaCreacionA',$cuidaUnoInfo->fechaCreacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveEstadoInicialA',$cuidaUnoInfo->llaveEstadoInicial,['hidden'=>'']) !!}
                                {!! Form::text('llaveGestionRealizadaA',$cuidaUnoInfo->llaveGestionRealizada,['hidden'=>'']) !!}
                                {!! Form::text('llaveEstadoTramiteA',$cuidaUnoInfo->llaveEstadoTramite,['hidden'=>'']) !!}
                                {!! Form::text('llaveEstadoFinalA',$cuidaUnoInfo->llaveEstadoFinal,['hidden'=>'']) !!}


                                <!--./==================================================================================-->
                                <!--./=========================== Datos basicos afiliado =================================================-->
                                {!! Form::text('tipoDocumentoA',$infoSiniestroEl->llaveTipoDocumento,['hidden'=>'']) !!}
                                {!! Form::text('numeroDocuentoA',$infoSiniestroEl->documento,['hidden'=>'']) !!}
                                {!! Form::text('nombreA',$infoSiniestroEl->nombre,['hidden'=>'']) !!}
                                {!! Form::text('direccionA',$infoSiniestroEl->direccionResi,['hidden'=>'']) !!}
                                {!! Form::text('departamentoA',$infoSiniestroEl->llaveDepartamento,['hidden'=>'']) !!}
                                {!! Form::text('ciudadA',$infoSiniestroEl->llaveCiudad,['hidden'=>'']) !!}
                                {!! Form::text('telefonoA',$infoSiniestroEl->telefono,['hidden'=>'']) !!}
                                {!! Form::text('numeroCelularA',$infoSiniestroEl->celular,['hidden'=>'']) !!}
                                {!! Form::text('correoA',$infoSiniestroEl->Correo,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                <!--./==================================================Empresa  =================================================-->
                                {!! Form::text('empresaA',$infoSiniestroEl->nit,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                {!! Form::text('modifica',Auth::user()->id,['hidden'=>'']) !!}


                                {!! Form::close() !!}
                            </div>

                            <!--==================================================Datos basicos empresa==================================================-->
                            <div class="tab-pane" id="diagnosticos">
                                {!! Form::hidden('sini',$infoSiniestroEl->id_elSiniestro,['class' => 'form-control form-control-sm', 'id' =>'idSiniestroDxEL' ]) !!}
                                <div class="card">
                                    <div class="card-body table-responsive pad">
                                        <div class="form-group col-sm-10 input-group-sm row" style="margin-left:0%;" >
                                            <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " data-toggle="modal" data-target="#modalDiagnostico" >Agregar Diagnóstico </button>
                                            </div>
                                        </div>  
                                        <div class="col-sm-12 col-md-12" id="ocultarTabla">
                                            <div id="tablaCie10SiniestroEl"></div>
                                        </div>                
                                    </div>
                                </div>
                            </div>
                            <!--==================================================Calificacion==================================================-->

                            <div class="tab-pane" id="calificacion">
                                <br>
                                @if($infoSiniestroEl->llaveCalificacionEl != NULL)
                                {!! Form::model($clfEl, ['route'=>['Calificacion_El.update',$clfEl->idElCalificaciones], 'method'=>'put'])  !!}
                                @endif
                                {!! Form::hidden('tipoSoli',$infoSiniestroEl->solicitud,['class' => 'form-control form-control-sm', 'id' =>'Txtsolicitud' ]) !!}
                                {!! Form::hidden('idRetornar',$infoSiniestroEl->id_elSiniestro,['class' => 'form-control form-control-sm' ]) !!}
                                {!! Form::text('TxtEstadoArl',$clfElDos->estado_siniestro,['class' => 'form-control form-control-sm', 'id' =>'TxtEstadoArl' ]) !!}

                                <section class="content col-12">
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Calificacion</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">  
                                                    <div class="col-3 ">
                                                        {!! Form::label('fechaGestionCali' , 'Fecha gestión médico ') !!}
                                                        {!! Form::text('fechaGestionCali',null,['class' => 'form-control form-control-sm','readonly'=>'']) !!}
                                                    </div>

                                                    <div class="col-3 ">
                                                        {!! Form::label('llaveUsuarioCalificadorEl' , 'Medico calificador') !!}
                                                        <select class="form-control form-control-sm "  name="llaveUsuarioCalificadorEl">

                                                            <option value="{{$clfEl->id}}">{{$clfEl->name}}</option>
                                                            @foreach  ($usuariosEl as $profe)
                                                            <option value="{{$profe -> id}}">{{$profe -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {!! Form::text('txtTipoSoli',$clfEl->solicitud,['class' => 'form-control form-control-sm','hidden'=>'']) !!}

                                                    <div class="col-3 ocultar" id="EstadoEps">
                                                        {!! Form::label('llaveEstadoElCalificacion' , 'Estado Primer oportunidad EPS') !!}
                                                        <select class="form-control form-control-sm "  name="llaveEstadoElCalificacion" id="SlsEstadoEps">
                                                            @if($clfEl->llaveEstadoElCalificacion != null)
                                                            <option value="{{$clfEl->id_estado_siniestro}}">{{$clfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif
                                                            @foreach  ($estadoEps as $estEps)
                                                            <option value="{{$estEps -> id_estado_siniestro}}">{{$estEps -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3 ocultar" id="EstadoArl">
                                                        {!! Form::label('llaveEstadoElCalificacion' , 'Estado Primer oportunidad ARL') !!}
                                                        <select class="form-control form-control-sm "  name="llaveEstadoElCalificacion" id="SlsEstadoArl" >
                                                            @if($clfEl->llaveEstadoElCalificacion != null)
                                                            <option value="{{$clfEl->id_estado_siniestro}}">{{$clfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($estadoArl as $esArl)
                                                            <option value="{{$esArl -> id_estado_siniestro}}">{{$esArl -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 ocultar" id="EstadoSolo">
                                                        {!! Form::label('llaveEstadoElCalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm "  name="llaveEstadoElCalificacion" id="SlsEstadoSolo" >
                                                            @if($clfEl->llaveEstadoElCalificacion != null)
                                                            <option value="{{$clfEl->id_estado_siniestro}}">{{$clfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($estadoArl as $esArl)
                                                            <option value="{{$esArl -> id_estado_siniestro}}">{{$esArl -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 date ocultar" id="DivfechaSolicitudPruebas">
                                                        {!! Form::label('fechaSolicitudPruebas' , 'Fecha solicitud pruebas ') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSolicitudPruebas',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha solicitud pruebas', 'id'=>'TxtfechaSolicitudPruebas']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 ocultar" id="DivBotonCargue">
                                                        {!! Form::label('llaveIngresoRehabilitacion' , 'Boton cargue Isarl') !!}
                                                        <select class="form-control form-control-sm "  name="bottonCargueIsarl" id="TxtBotonCargue">
                                                            @if($clfEl->llaveIngresoRehabilitacion != null)
                                                            <option value="{{$clfEl->id_estado_siniestro}}">{{$clfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif                                                             

                                                            @foreach  ($ingresoRe as $ingreso)
                                                            <option value="{{$ingreso -> idIngresoRehabilitacion}}">{{$ingreso -> ingresoRehabilitacion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <?php $now = new \DateTime(); ?>
                                                    @if($clfEl->fechaEnvioComiteCodess != null)
                                                    <div class="col-2 ">
                                                        {!! Form::label('fechaEnvioComiteCodess' , 'Fecha envio comite') !!}
                                                        <input value="{{$clfEl->fechaEnvioComiteCodess}}" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaEnvioComite" id="TxtfechaEnvioComiteCodess">    
                                                    </div>
                                                    @endif
                                                    @if($clfEl->fechaEnvioComiteCodess == null)
                                                    <div class="col-2 ocultar" id="DivfechaEnvioComiteCodess" >
                                                        {!! Form::label('fechaEnvioComite' , 'Fecha envio comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaEnvioComiteCodess" id="TxtfechaEnvioComiteCodess">    
                                                    </div>
                                                    @endif
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaAvalComiteCodess' , 'Fecha aval comité Codess ') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaAvalComiteCodess',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha aval comité Codess', 'id'=>'TxtFechaCreacion']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <!-- -->
                                                    <div class="col-3 ">
                                                        {!! Form::label('llaveIngresoRehabilitacion' , 'Ingreso rehabilitación') !!}
                                                        <select class="form-control form-control-sm "  name="llaveIngresoRehabilitacion">
                                                            @if($clfEl->llaveIngresoRehabilitacion != null)
                                                            <option value="{{$clfEl->id_estado_siniestro}}">{{$clfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif                                                             

                                                            @foreach  ($ingresoRe as $ingreso)
                                                            <option value="{{$ingreso -> idIngresoRehabilitacion}}">{{$ingreso -> ingresoRehabilitacion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                             


                                                    <div class="col-3  ocultar" id="oportunidadEps">
                                                        {!! Form::label('llaveOrigenOportunidadEps' , 'Origen primera oportunidad eps') !!}
                                                        <select class="form-control form-control-sm "  name="llaveOrigenOportunidadEps" id="SlsOportunidadEps">
                                                            @if($clfEl->llaveOrigenOportunidadEps != null)
                                                            <option value="{{$clfEl->id_origen_definicion}}">{{$clfEl->origen_definicion}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif  
                                                            @foreach  ($origenEps as $oriEps)
                                                            <option value="{{$oriEps -> id_origen_definicion}}">{{$oriEps -> origen_definicion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-4  ocultar" id="oportunidadPositiva">
                                                        {!! Form::label('llaveOrigenOportunidadPositiva' , 'Origen primera oportunidad Positiva') !!}
                                                        <select class="form-control form-control-sm "  name="llaveOrigenOportunidadPositiva" id="SlsOportunidadPositiva">
                                                            @if($clfEl->llaveOrigenOportunidadPositiva != null)
                                                            <option value="{{$clfElDos->id_origen_definicion}}">{{$clfElDos->origen_definicion}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif  

                                                            @foreach  ($origenoportinidades as $origenoportinidad)
                                                            <option value="{{$origenoportinidad -> id_origen_definicion}}">{{$origenoportinidad -> origen_definicion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3 date" id="DivRadicadoSalida">
                                                        {!! Form::label('fechaRadicadoSalida' , 'Fecha radicado salida') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRadicadoSalida',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha radicado salida', 'id'=>'TxtRadicadoSalida']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 ocultar" id="DivNumeroRadicadoSalida">
                                                        {!! Form::label('numeroRadicadoSalida' , 'Número radicado salida') !!}
                                                        {!! Form::text('numeroRadicadoSalida',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Número radicado salida', 'id'=>'TxtNumeroRadicadoSalida']) !!}
                                                    </div> 

                                                    <div class="col-3" id="DivCanalEntradaPruebas">
                                                        {!! Form::label('llaveCanalEntradaPruebas' , 'Canal entrada pruebas') !!}
                                                        <select class="form-control form-control-sm "  name="llaveCanalEntradaPruebas" id="TxtCanalEntradaPruebas">
                                                            @if($clfEl->llaveCanalEntradaPruebas != null)
                                                            <option value="{{$clfEl->id_entrada_pruebas}}">{{$clfEl->entrada_prueba}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif  
                                                            @foreach  ($entradaPruebas as $entradaPrueba)
                                                            <option value="{{$entradaPrueba -> id_entrada_pruebas}}">{{$entradaPrueba -> entrada_prueba}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3" id="DivRadicadoEntradaPruebas">
                                                        {!! Form::label('radicadoEntradaPruebas' , 'Radicado entrada pruebas') !!}
                                                        {!! Form::text('radicadoEntradaPruebas',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Número radicado salida', 'id'=>'TxtRadicadoEntradaPruebas']) !!}
                                                    </div>

                                                    <div class="col-3 date" id="DivFechaIngresoPruebas">
                                                        {!! Form::label('fechaIngresoPruebas' , 'Fecha Ingreso pruebas') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaIngresoPruebas',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad', 'id'=>'TxtFechaIngresoPruebas']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>

                                                    <div class="form-group col-12 ocultar" id=divSustentacionMedico style="margin-top: 1%">
                                                        <label>Sustentacion medico</label>
                                                        <textarea  class="form-control"  rows="3" name="sustentacion" id="TxtSustentacionMedico" placeholder="Sustentacion medico ...">{{$clfEl->sustentacion}}</textarea>
                                                    </div>
                                                    <div class="form-group col-12" style="margin-top: 1%">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control"  rows="3" name="TxtObservacionElCali" placeholder="Observaciones ..."></textarea>
                                                    </div>
                                                    <?php
                                                    $contador2 = 1;
                                                    if (count($observacionCalificacion)) {
                                                        ?>
                                                        <div class="col-12" style="margin-top: 1%;">
                                                            <div class="card direct-chat direct-chat-primary collapsed-card">
                                                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                                                    <h6 class="card-title">Observaciones</h6>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body"  >
                                                                    <div class="direct-chat-messages">
                                                                        <table  class="table table-stripped table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="20">N°</th>
                                                                                    <th width="650">Observacion</th>    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                @foreach($observacionCalificacion as $obs)
                                                                                <tr>
                                                                                    <td>{{$contador2}}</td>
                                                                                    <td>{{$obs -> observacion}}</td>
                                                                                </tr>
                                                                                <?php $contador2 = $contador2 + 1; ?>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>                                                          
                                                                </div>                                                          
                                                            </div>  
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>



                                                    <!--./==================================================================================-->
                                                    <!--./=========================== Datos basicos afiliado =================================================-->
                                                    {!! Form::text('llaveEstadoElCalificacionA',$clfEl->llaveEstadoElCalificacion,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveUsuarioCalificadorElA',$clfEl->llaveUsuarioCalificadorEl,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaGestionMedicoA',$clfEl->fechaGestionMedico,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaSolicitudPruebasA',$clfEl->fechaSolicitudPruebas,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaEnvioComiteCodessA',$clfEl->fechaEnvioComiteCodess,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaAvalComiteCodessA',$clfEl->fechaAvalComiteCodess,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaRadicadoSalidaA',$clfEl->fechaRadicadoSalida,['hidden'=>'']) !!}
                                                    {!! Form::text('numeroRadicadoSalidaA',$clfEl->numeroRadicadoSalida,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveIngresoRehabilitacionA',$clfEl->llaveIngresoRehabilitacion,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveCanalEntradaPruebasA',$clfEl->llaveCanalEntradaPruebas,['hidden'=>'']) !!}
                                                    {!! Form::text('radicadoEntradaPruebasA',$clfEl->radicadoEntradaPruebas,['hidden'=>'']) !!}
                                                    {!! Form::text('fechaIngresoPruebasA',$clfEl->fechaIngresoPruebas,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveOrigenOportunidadEpsA',$clfEl->llaveOrigenOportunidadEps,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveOrigenOportunidadPositivaA',$clfEl->llaveOrigenOportunidadPositiva,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveCoberturaA',$clfEl->llaveCobertura,['hidden'=>'']) !!}
                                                    {!! Form::text('raSalidaCoverturaDevolucionEpsA',$clfEl->raSalidaCoverturaDevolucionEps,['hidden'=>'']) !!}
                                                    {!! Form::text('llaveRevicionCoberturaA',$clfEl->llaveRevicionCobertura,['hidden'=>'']) !!}

                                                    <!--./===================================================================================================-->
                                                    {!! Form::text('modifica',Auth::user()->id,['hidden'=>'']) !!}




                                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="permisosBotonCalificacion" >
                                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>  
                                {!! Form::close() !!}
                            </div>



                            <!--==================================================Calificacion==================================================-->

                            <div class="tab-pane" id="preCalificacion">
                                <br>
                                @if($infoSiniestroEl->llavePrecalificacionEl != NULL)
                                {!! Form::model($preClfEl, ['route'=>['PreCalificacion_El.update',$preClfEl->idElPrecalificacion], 'method'=>'put'])  !!}
                                @endif
                                <section class="content col-12">
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Calificacion</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">  
                                                    <div class="col-3 date" id="">
                                                        {!! Form::label('fechaAsignacionEl' , 'Fecha asignacion') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaAsignacionEl',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignacion', 'id'=>'TxtRadicadoSalida','readonly'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveEstadoElCalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm "  name="llaveEstadoElCalificacion" id="estadoPeCalificacion" >
                                                            @if($preClfEl->llaveEstadoGestionEl != null)
                                                            <option value="{{$preClfEl->id_estado_siniestro}}">{{$preClfEl->estado_siniestro}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($estadoPre as $estadoPr)
                                                            <option value="{{$estadoPr -> id_estado_siniestro}}">{{$estadoPr -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {!! Form::text('no',$preClfEl->llaveSubEstadoGestionEl,['class' => 'form-control form-control-sm','id'=>'subestadoMostarPreCali','hidden'=>""]) !!}

                                                    <div class="col-3 subEstadoPeCalificacion" id="">
                                                        {!! Form::label('llaveEstadoElCalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm "  name="llaveEstadoElCalificacion" id="" >                                                       
                                                        </select>
                                                    </div>

                                                    <div class="col-3 ">
                                                        {!! Form::label('llaveUsuarioPrecalificacionEl' , 'Profesional') !!}
                                                        <select class="form-control form-control-sm "  name="llaveUsuarioPrecalificacionEl">
                                                            <option value="{{$preClfEl->id}}">{{$preClfEl->name}}</option>
                                                            @foreach  ($usuariosEl as $profe)
                                                            <option value="{{$profe -> id}}">{{$profe -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveTipoEventoReportadoEl' , 'Tipo evento reporte') !!}
                                                        <select class="form-control form-control-sm "  name="llaveTipoEventoReportadoEl" id="" >
                                                            @if($preClfEl->llaveEstadoGestionEl != null)
                                                            <option value="{{$preClfEl->id_tipo_evento}}">{{$preClfEl->tipo_evento}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($tipoEvento as $tipoEven)
                                                            <option value="{{$tipoEven -> id_tipo_evento}}">{{$tipoEven -> tipo_evento}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3" id="">
                                                        {!! Form::label('cargoAseguradoEl' , 'Cargo asegurado') !!}
                                                        {!! Form::text('cargoAseguradoEl',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Cargo asegurado', 'id'=>'TxtRadicadoEntradaPruebas']) !!}
                                                    </div>
                                                    <div class="col-3" id="">
                                                        {!! Form::label('descripcionCasoEl' , 'Descripcion del caso') !!}
                                                        {!! Form::text('descripcionCasoEl',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Descripcion del caso', 'id'=>'TxtRadicadoEntradaPruebas']) !!}
                                                    </div>

                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveConceptoAfiliacionesEl' , 'Concepto afiliaciones') !!}
                                                        <select class="form-control form-control-sm "  name="llaveConceptoAfiliacionesEl" id="" >
                                                            @if($preClfEl->llaveConceptoAfiliacionesEl != null)
                                                            <option value="{{$preClfEl->idConceptoAfiliacion}}">{{$preClfEl->ConceptoAfiliacion}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($conceptos as $concepto)
                                                            <option value="{{$concepto -> idConceptoAfiliacion}}">{{$concepto -> ConceptoAfiliacion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveSolicitudPruebasEl' , 'Solicitud de pruebas') !!}
                                                        <select class="form-control form-control-sm "  name="llaveSolicitudPruebasEl" id="" >
                                                            @if($preClfEl->llaveSolicitudPruebasEl != null)
                                                            <option value="{{$preClfEl->idSolicitudPrueba}}">{{$preClfEl->prueba}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($solicitudPruebas as $solicitudPrueba)
                                                            <option value="{{$solicitudPrueba -> idSolicitudPrueba}}">{{$solicitudPrueba -> prueba}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 date" id="">
                                                        {!! Form::label('fechaSolicitudPruebas' , 'Fecha solicitud pruebas') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSolicitudPruebas',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha solicitud pruebas', 'id'=>'TxtRadicadoSalida']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveCanalEnvio' , 'Canal Envio') !!}
                                                        <select class="form-control form-control-sm "  name="llaveCanalEnvio" id="" >
                                                            @if($preClfEl->llaveCanalEnvio != null)
                                                            <option value="{{$preClfEl->idCanalEnvio}}">{{$preClfEl->CanalEnvio}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($canalEnvios as $canalEnvio)
                                                            <option value="{{$canalEnvio -> idCanalEnvio}}">{{$canalEnvio -> CanalEnvio}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveReinteracionPruebasEl' , 'Reiteracion pruebas') !!}
                                                        <select class="form-control form-control-sm "  name="llaveReinteracionPruebasEl" id="" >
                                                            @if($preClfEl->llaveReinteracionPruebasEl != null)
                                                            <option value="{{$preClfEl->idReiteracionPruebas}}">{{$preClfEl->reiteracionPruebas}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($reiteracionPruebas as $reiteracionPrueba)
                                                            <option value="{{$reiteracionPrueba -> idReiteracionPruebas}}">{{$reiteracionPrueba -> reiteracionPruebas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveCanalReinteracionPruebasEl' , 'Canal reiteracion') !!}
                                                        <select class="form-control form-control-sm "  name="llaveCanalReinteracionPruebasEl" id="" >
                                                            @if($preClfEl->llaveCanalReinteracionPruebasEl != null)
                                                            <option value="{{$preClfEl->idCanalReiteracion}}">{{$preClfEl->CanalReiteracion}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($canalReiteraciones as $canalReiteracion)
                                                            <option value="{{$canalReiteracion -> idCanalReiteracion}}">{{$canalReiteracion -> CanalReiteracion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 date" id="">
                                                        {!! Form::label('fechaReinteracionPruebasEl' , 'Fecha reiteracion') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaReinteracionPruebasEl',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha reiteracion', 'id'=>'TxtRadicadoSalida']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveAltoCostoUciMortalEL' , 'Alto costo(UCI Mortal)') !!}
                                                        <select class="form-control form-control-sm "  name="llaveAltoCostoUciMortalEL" id="" >
                                                            @if($preClfEl->llaveAltoCostoUciMortalEL != null)
                                                            <option value="{{$preClfEl->idAltoCostoUciMortal}}">{{$preClfEl->altoCostoUciMortal}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($altoCostouciMortales as $altoCostouciMortal)
                                                            <option value="{{$altoCostouciMortal -> idAltoCostoUciMortal}}">{{$altoCostouciMortal -> altoCostoUciMortal}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveMarcacionIsarlEl' , 'Marcacion ISARL decreto 538/20') !!}
                                                        <select class="form-control form-control-sm "  name="llaveMarcacionIsarlEl" id="" >
                                                            @if($preClfEl->llaveMarcacionIsarlEl != null)
                                                            <option value="{{$preClfEl->idMarcacionIsarDecreto}}">{{$preClfEl->marcacionIsarDecreto}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($marcacionIsarDecretos as $marcacionIsarDecreto)
                                                            <option value="{{$marcacionIsarDecreto -> idMarcacionIsarDecreto}}">{{$marcacionIsarDecreto -> marcacionIsarDecreto}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveSectorEl' , 'Sector') !!}
                                                        <select class="form-control form-control-sm "  name="llaveSectorEl" id="" >
                                                            @if($preClfEl->llaveSectorEl != null)
                                                            <option value="{{$preClfEl->idSector}}">{{$preClfEl->sector}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($sectores as $sector)
                                                            <option value="{{$sector -> idSector}}">{{$sector -> sector}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                                 
                                                    <div class="col-3" id="">
                                                        {!! Form::label('seguimiento' , 'Seguimiento') !!}
                                                        {!! Form::text('seguimiento',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Seguimiento', 'id'=>'TxtRadicadoEntradaPruebas']) !!}
                                                    </div>
                                                    <div class="col-3 " id="">
                                                        {!! Form::label('llaveCalificacionPrimeraOportunidadEpsArl' , 'Calificador primera oportunidad') !!}
                                                        <select class="form-control form-control-sm "  name="llaveCalificacionPrimeraOportunidadEpsArl" id="" >
                                                            @if($preClfEl->llaveCalificacionPrimeraOportunidadEpsArl != null)
                                                            <option value="{{$preClfEl->id_eps}}">{{$preClfEl->eps}}</option>
                                                            @else
                                                            <option value="">Seleccionar</option>
                                                            @endif     
                                                            @foreach  ($eps as $ep)
                                                            <option value="{{$ep -> id_eps}}">{{$ep -> eps}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3" id="">
                                                        {!! Form::label('creacionEspecialSiniestroDx' , 'Marcacion especial siniestro DX') !!}
                                                        {!! Form::text('creacionEspecialSiniestroDx',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Marcacion especial siniestro DX', 'id'=>'TxtRadicadoEntradaPruebas']) !!}
                                                    </div>
                                                    <div class="col-5 date" id="">
                                                        {!! Form::label('cambioFechaSiniestroIndemnizaciones' , 'Cambio fecha siniestro por solicitud G. indemnizaciones') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('cambioFechaSiniestroIndemnizaciones',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha radicado salida', 'id'=>'TxtRadicadoSalida']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="card-body col-12">
                                                        <h6><b>SELECCION DE DOCUMENTOS APORTADOS</b></h6>
                                                        <div class="row text-center ">
                                                            <label for="lunes" class="btn btn-default colorBotonDias ">
                                                                Furat/Furel
                                                                <input type="checkbox"   id="lunes"   class="badgebox "><span class="badge">&check;</span>
                                                            </label>
                                                            &nbsp;
                                                            <label for="martes" class="btn btn-default colorBotonDias">
                                                                Certificacion
                                                                <input type="checkbox" id="martes"  class="badgebox"><span class="badge">&check;</span>
                                                            </label>
                                                            &nbsp;
                                                            <label for="miercoles" class="btn btn-default colorBotonDias">
                                                                Laboratorio
                                                                <input type="checkbox" id="miercoles"   class="badgebox"><span class="badge">&check;</span>
                                                            </label>
                                                            &nbsp;
                                                            <label for="jueves" class="btn btn-default colorBotonDias">
                                                                Historia clinica
                                                                <input  type="checkbox" id="jueves"  class="badgebox"><span class="badge">&check;</span>
                                                            </label>
                                                            &nbsp;
                                                            <label for="viernes" class="btn btn-default colorBotonDias">
                                                                Consentimiento
                                                                <input type="checkbox" id="viernes"   class="badgebox"><span class="badge">&check;</span>
                                                            </label>
                                                            &nbsp;
                                                            <label for="sabado" class="btn btn-default colorBotonDias">
                                                                Otros
                                                                <input type="checkbox" id="sabado"  value="" class="badgebox"><span class="badge">&check;</span>
                                                            </label>
                                                            <input name="furatFuret" id="CheBoxFuratFurel" value="" class="ocultar">
                                                            <input name="certificacion" id="CheBoxCertificacion" value="" class="ocultar">
                                                            <input name="laboratorio" id="CheBoxLaboratorio" value="" class="ocultar">
                                                            <input name="historiaClinica" id="CheBoxHistoriaClinica" value="" class="ocultar">
                                                            <input name="consentimiento" id="CheBoxConsentimiento" value="" class="ocultar">
                                                            <input name="otros" id="CheBoxOtros" value="" class="ocultar">

                                                            <input name="" id="TxtLunes" value="g"  hidden="">
                                                            <input name="" id="TxtMartes" value="g"  hidden="">
                                                            <input name="" id="Txtmiercoles" value="g"  hidden="">
                                                            <input name="" id="TxtJueves" value="g"  hidden="">
                                                            <input name="" id="TxtViernes" value="g"  hidden="">
                                                            <input name="" id="TxtSabado" value="g"  hidden="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12" style="margin-top: 1%">
                                                        <label>observacionesPreCalificacion</label>
                                                        <textarea  class="form-control"  rows="3" name="TxtObservacionElCali" placeholder="Observaciones ..."></textarea>
                                                    </div>
                                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="permisosBotonCalificacion" >
                                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>  
                                {!! Form::close() !!}
                            </div>


                            <!--===========================================Historial======================================================-->

                            <div class="tab-pane" id="historial">
                                <div class="content" style="margin-top: 2px;">
                                    <!-- Main content -->
                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- The time line -->
                                                    <div class="timeline">
                                                        <?php
                                                        $conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
                                                        $idsini = $infoSiniestroEl->id_elSiniestro;
                                                        $sql5 = "SELECT 
                                                                    DATE(t.created_at) as fe
                                                                FROM
                                                                    tbl_trazas AS t
                                                                        INNER JOIN
                                                                    tbl_el_siniestros AS s ON s.id_elSiniestro = t.llaveSiniestroEL
                                                                    where llaveSiniestroEL = $idsini
                                                                GROUP BY DATE(t.created_at);";
                                                        $result5 = mysqli_query($conexion1, $sql5);
                                                        while ($resultado5 = mysqli_fetch_array($result5)) {
                                                            $fecha = $resultado5["fe"];
                                                            ?>
                                                            <div class="time-label">
                                                                <span class="bg-green"><?php echo $fecha ?></span>
                                                            </div>
                                                            <div>
                                                                <i class="fas fa-heading"></i>
                                                                <div class="timeline-item">
                                                                    <div class="timeline-body">
                                                                        <table  class="table table-stripped table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="">ID SINIESTRO</th>
                                                                                    <th width="">MODIFICADO POR</th>  
                                                                                    <th width="">MODIFICACIÓN</th>    
                                                                                    <th width="">INFORMACIÓN ANTERIOR</th>   
                                                                                    <th width="">INFORMACIÓN NUEVA</th>                                                                                
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                <?php
                                                                                $sql = "SELECT
                                                                                           id_elSiniestro,
                                                                                           tipo,
                                                                                           anterior,
                                                                                           nuevo,
                                                                                           fecha_actualizacion,
                                                                                           name,
                                                                                           t.created_at as cuando
                                                                                       FROM
                                                                                           tbl_trazas AS t
                                                                                               INNER JOIN
                                                                                           tbl_el_siniestros AS s ON s.id_elSiniestro = t.llaveSiniestroEL
                                                                                               INNER JOIN
                                                                                           users AS u ON u.id = t.llaveUserPcTtraza
                                                                                       WHERE
                                                                                           llaveSiniestroEL = $idsini
                                                                                               AND DATE(t.created_at) = '$fecha';";
                                                                                $result = mysqli_query($conexion1, $sql);
                                                                                while ($resultado = mysqli_fetch_array($result)) {
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $resultado["id_elSiniestro"]; ?></td>
                                                                                        <td><?php echo $resultado["name"]; ?></td>
                                                                                        <td><?php echo $resultado["tipo"]; ?></td>
                                                                                        <td><?php echo $resultado["anterior"]; ?></td>
                                                                                        <td><?php echo $resultado["nuevo"]; ?></td>

                                                                                    </tr>                                                                      
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <!-- END timeline item -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                        </div>
                                        <!-- /.timeline -->
                                    </section>
                                    <!-- /.content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.modalDiagnosticoEl') 

@endsection

