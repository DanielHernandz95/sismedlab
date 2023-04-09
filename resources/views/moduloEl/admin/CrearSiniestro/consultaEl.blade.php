@extends('/homeEl')
@section('tatle','app')

@section('consulta')
<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#solicitud" data-toggle="tab">Solicitudes</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="solicitud">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="fas fa-diagnoses"></i> Documento</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text"  id="documento" name="TxtAfiliado" class="form-control solo_numero ">
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-success btn-flat color_texto " onclick="comprobarUsuarioEl()"><i class="fas fa-search"></i>  <b>Buscar</b></button>
                                                    </span>
                                                </div> 
                                            </div>
                                        </div>
                                        <img src="/imagenes/loader.gif" id="loaderIcon" style="display:none; width: 25%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="estadousuario"></div> 
                <!--==================================================Datos =================================================-->
                @if(Auth::user()->llaveRol_usuario !=  15 && Auth::user()->llaveRol_usuario !=  12  ) 
                {!! Form::open(['route' => 'CrearEl.store', 'method' => 'POST']) !!}
                <div id="formularioPcl" style="display: none">
                    <section class="content col-12" >
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Ingrese los detalles del siniestro</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 valorEntrada" >
                                            {!! Form::label('txtCanalEntrada' , 'Canal entrada') !!}
                                            <select class="form-control form-control-sm "  name="txtCanalEntrada" required="" id="canalEntradaEl">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($entradaPclEl as $entrada)
                                                <option value="{{$entrada -> id_entrada}}">{{$entrada -> entrada}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col- " id="">
                                            {!! Form::label('txtTipoSolicitud' , 'Tipo de solicitud') !!}
                                            <select class="form-control form-control-sm"  name="txtTipoSolicitud" required="" id="SlsCrearSiniestroTipoSoli">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($tipoSolicitudEl as $tipoSoli)
                                                <option value="{{$tipoSoli -> id_solicitud}}">{{$tipoSoli -> solicitud}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtCovid' , 'Marcación COVID') !!}
                                            <select class="form-control form-control-sm "  name="txtCovid" required="">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($covid as $cov)
                                                <option value="{{$cov -> idCovid}}">{{$cov -> covid}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-3">
                                            {!! Form::label('txtCobertura' , 'Cobertura') !!}
                                            <select class="form-control form-control-sm "  name="txtCobertura" required="" id="txtCobertura">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($cobertura as $cober)
                                                <option value="{{$cober -> idCobertura}}">{{$cober -> cobertura}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3" id="DivraSaEnCarCobeODevoEPs">
                                            {!! Form::label('txtRadicadoCoberturaDebolucion' , 'Radicado cobertura o dev. eps') !!}
                                            {!! Form::text('txtRadicadoCoberturaDebolucion',null,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Radicado salida envió carta cobertura o devolución eps','id'=>"TxtraSaEnCarCobeODevoEPs"]) !!}
                                            <div id="existeSiniestro"></div>
                                        </div> 
                                        <div class="col-3">
                                            {!! Form::label('txtRevisionCobertura' , 'Revision cobertura') !!}
                                            <select class="form-control form-control-sm "  name="txtRevisionCobertura" required="">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($revicionCoberturas as $revicionCob)
                                                <option value="{{$revicionCob -> idRevisionCobertura}}">{{$revicionCob -> revisionCobertura}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 date">
                                            {!! Form::label('TxtFechaRadicacionArlPositiva' , 'Fecha radicacion a ARL positiva') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaRadicacionArlPositiva',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha radicacion a ARL positiva', 'required'=>""]) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-3 ocultar" id="DivNumeroRadicado">
                                            {!! Form::label('TxtNumeroRadicadoEntrada' , 'Número radicado entrada') !!}
                                            <div class="input-group ">
                                                {!! Form::text('TxtNumeroRadicadoEntrada',null,['class' => 'form-control form-control-sm','placeholder' => 'Numero radicado entrada', 'id'=>"TxtNumeroRadicado"]) !!}
                                            </div> 
                                        </div>
                                        <div class="col-3 departaSiniestro">
                                            {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                            <select class="form-control form-control-sm "  name="txtDepartamentoSiniestro">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($departamento as $department)
                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 ciuidadMSiniestro">
                                            {!! Form::label('TxtCiudadSiniestro' , 'Ciudad') !!}
                                            <select class="form-control form-control-sm ciuidadMSiniestro"  name="TxtCiudadSiniestro"  id="">                                          
                                            </select>
                                        </div>
                                        <div class="col-3 date">
                                            {!! Form::label('TxtFechaEnfermedad' , 'Fecha enfermedad') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaEnfermedad',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad', 'required'=>""]) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtNumeroSiniestro' , 'Numero siniestro') !!}
                                            {!! Form::text('txtNumeroSiniestro',null,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Numero siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()','required'=>""]) !!}
                                            <div id="existeSiniestro"></div>
                                        </div>                                          
                                    
                                        {!! Form::text('TxtUsuarioQuienCrea',Auth::user()->id,['class' => 'form-control form-control-sm ', 'hidden'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--==================================================Datos basicos empresa==================================================-->
                    <section class="content col-12" id="divInfoEps">
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Información EPS</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5" >
                                            {!! Form::label('TxtEps' , 'EPS') !!}
                                            <select class="form-control form-control-sm " name="TxtEps" id="idEps" onchange="eps()"  >
                                                <option value="">Seleccionar</option>
                                                @foreach  ($eps as $e)
                                                <option value="{{$e -> id_eps}}">{{$e -> eps}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="col-2">
                                            <label>Folio</label>
                                            <input  type="text"  name="TxtFolio" class="form-control form-control-sm" placeholder="Folio" id="TxtFolio">
                                        </div>
                                        <div class="row col-12" id="epsExiste"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!--==================================================Datos basicos empresa==================================================-->
                    <section class="content col-12" id="CuidaUno" style="display: none">
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Asignación casos cuida 1</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 date">
                                            {!! Form::label('TxtFechaRevision' , 'Fecha revision') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaRevision',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad','id'=>'TxtFechaRevision']) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtAfiliacion' , 'Afiliacion') !!}
                                            <select class="form-control form-control-sm "  name="TxtAfiliacion" id="TxtAfiliacion">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($afiliado as $afili)
                                                <option value="{{$afili->idAfiliacion}}">{{$afili->afiliacion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtCreado' , 'Creado') !!}
                                            <select class="form-control form-control-sm "  name="TxtCreado" id="TxtCreado" >
                                                <option value="">Seleccionar</option>
                                                @foreach  ($creado as $creado)
                                                <option value="{{$creado->idCreado}}">{{$creado->creado}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 date">
                                            {!! Form::label('TxtFechaCreacion' , 'Fecha creación ') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaCreacion',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha enfermedad', 'id'=>'TxtFechaCreacion']) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtEstadoInicial' , 'Estado inicial') !!}
                                            <select class="form-control form-control-sm "  name="TxtEstadoInicial"  id="TxtEstadoInicial">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($estadoIniciail as $estadoIniciail)
                                                <option value="{{$estadoIniciail->id_estado_siniestro}}">{{$estadoIniciail->estado_siniestro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtGestionRealizar' , 'Gestión a realizar') !!}
                                            <select class="form-control form-control-sm "  name="TxtGestionRealizar"  id="TxtGestionRealizar">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($gestionRealizar as $gestionRea)
                                                <option value="{{$gestionRea->idGestionRealizar}}">{{$gestionRea->gestionArealizar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtEstadoTramite' , 'Estado tramite') !!}
                                            <select class="form-control form-control-sm "  name="TxtEstadoTramite" id="TxtEstadoTramite">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($estadoTramite as $estadoTramite)
                                                <option value="{{$estadoTramite->id_estado_siniestro}}">{{$estadoTramite->estado_siniestro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtEstadoFinal' , 'Estado final') !!}
                                            <select class="form-control form-control-sm "  name="TxtEstadoFinal" id="TxtEstadoFinal">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($estadoFinal as $estadoFinal)
                                                <option value="{{$estadoFinal->id_estado_siniestro}}">{{$estadoFinal->estado_siniestro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12" style="margin-top: 1%">
                                            <label>Observaciones</label>
                                            <textarea  class="form-control"  rows="3" name="TxtObservacionElCuida" placeholder="Observaciones ..."></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--==================================================Datos basicos empresa==================================================-->
                    <section class="content col-12" id="formularioBasicoAfiliadoEl">
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Datos basicos afiliado</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">                                   
                                            {!! Form::label('TxtTipoDocumento' , 'Tipo Documento') !!}
                                            <select class="form-control form-control-sm "  name="TxtTipoDocumento" id="crearTipoDicumento" >
                                                <option value="">Seleccionar</option>
                                                @foreach  ($tipoDocumentoAfiliado as $tipoDocumenAfi)
                                                <option value="{{$tipoDocumenAfi->id_tipo_docuemtno}}">{{$tipoDocumenAfi->tipo_documento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtNumeroDocumento' , 'Numero Documento') !!}
                                            <input name="txtNumeroDocumento" class="form-control form-control-sm" id="cedula2" readonly="" >
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtNombre' , 'Nombre') !!}
                                            {!! Form::text('txtNombre',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Nombre','id'=>'CrearANombre']) !!}
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtDireccion' , 'Direccion') !!}
                                            {!! Form::text('txtDireccion',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Direccion','id'=>'CrearADireccion']) !!}
                                        </div>
                                        <div class="col-3 departa">
                                            {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                            <select class="form-control form-control-sm "  name="txtDepartamento" id="crearDepartamento">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($departamento as $department)
                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 ciuidadM">
                                            {!! Form::label('txtDepartamento' , 'Ciudad') !!}
                                            <select class="form-control form-control-sm ciuidadM"  name="llaveCiudad" id="crearCiudad">                                          
                                            </select>
                                        </div>
                                        <div class="col-3 departa">
                                            {!! Form::label('llaveGenero' , 'Genero') !!}
                                            <select class="form-control form-control-sm "  name="TxtGenero" id="crearGenero">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($genero as $gen)
                                                <option value="{{$gen -> idGenero}}">{{$gen -> genero}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 date">
                                            {!! Form::label('fechaNacimiento' , 'Fecha nacimiento') !!}
                                            <div class="input-group date">
                                                {!! Form::text('fechaNacimiento',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha nacimiento', 'id'=>'crearFechaNacimiento']) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>

                                        <div class="col-3">
                                            {!! Form::label('txtTelefonoFijo' , 'Telefono fijo') !!}
                                            {!! Form::text('txtTelefonoFijo',null,['class' => 'form-control form-control-sm','placeholder' => 'Telefono fijo','id'=>'CrearTelefono']) !!}
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtNumeroCelular' , 'Numero celular') !!}
                                            {!! Form::text('txtNumeroCelular',null,['class' => 'form-control form-control-sm','placeholder' => 'Numero celular','id'=>'CrearANumero']) !!}
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtCorreo' , 'Correo') !!}
                                            {!! Form::text('txtCorreo',null,['class' => 'form-control form-control-sm','placeholder' => 'Correo','id'=>'CrearACorreo']) !!}
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div id="formularioBasicoAfiliadoLlenoEl"></div>
                    <!--==================================================Datos basicos empresa==================================================-->
                    <section class="content col-12">
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Datos basicos empresa</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 ">
                                            <label>Nit empleador</label>
                                            <input type="text" name="TxtNitEmpresa" class="form-control form-control-sm" id="idEmpleador" onBlur="comprobarEmpresa()" placeholder="Nit" required="">
                                        </div> 
                                        <!--=====================Campos Empresa Cargados=================================-->
                                        <div class="row col-12" id="empresaSiExiste"></div>
                                        <div class="row col-12" id="empresasMasPorNit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%; display: none" id="botonCrearSiniestroPcl">
                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                        </div> 
                    </div> 

                </div>


                {!! Form::close() !!}
                @endif
            </div>
        </div>

    </div>
</div>


@endsection

