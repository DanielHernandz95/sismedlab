@extends('plantilla.template')
@section('tatle','app')

@section('formulario')
<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#datosBasicos" data-toggle="tab">Datos Basicos</a></li>
                            <li class="nav-item"><a class="nav-link" href="#seguimientos" data-toggle="tab">Seguimiento</a></li>
                            <li class="nav-item"><a class="nav-link" href="#diagnosticos" data-toggle="tab">Diagnosticos</a></li>
                            @if($infoSiniestro->llavePrecalificacion != NULL)
                            <li class="nav-item"><a class="nav-link" href="#preCalificacion" data-toggle="tab">PreCalificacion</a></li>
                            @endif
                            @if($infoSiniestro->llaveCalificacion != NULL)
                            <li class="nav-item"><a class="nav-link" href="#calificacion" data-toggle="tab">Calificacion</a></li>
                            @endif
                            @if($infoSiniestro->llaveRecalificacion != NULL)
                            <li class="nav-item"><a class="nav-link" href="#recalificacion" data-toggle="tab">ReCalificacion</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="#adicion" data-toggle="tab">Adicion DX</a></li>
                            <li class="nav-item"><a class="nav-link" href="#historial" data-toggle="tab">Historial</a></li>

                        </ul>
                    </div>
                    <div class="" style="background-color: #fff; ">
                        <div class="tab-content">
                            <div class="tab-pane active" id="datosBasicos">
                                {!! Form::model($infoSiniestro, ['route'=>['Siniestro.update',$infoSiniestro->idSiniestroPcl], 'method'=>'put'])  !!}
                                <br>
                                <div id="" >
                                    <section class="content col-12" >
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Detalles del siniestro</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    {!! Form::text('usuarioRol',Auth::user()->llaveRol_usuario,['class' => 'form-control form-control-sm ', 'id'=>'validacionRol','hidden'=>'']) !!}
                                                    {!! Form::text('usuariocreador',$infoSiniestro->llaveUsuarioQuienCrea,['class' => 'form-control form-control-sm ', 'id'=>'usuarioCreador','hidden'=>'']) !!}
                                                    {!! Form::text('usuarioLoin',Auth::user()->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioLoginActual','hidden'=>'']) !!}
                                                    {!! Form::text('usuarioPrecali',$pre->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoPrecali','hidden'=>'']) !!}
                                                    {!! Form::text('usuarioCali',$clf->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoCali','hidden'=>'']) !!}
                                                    {!! Form::text('varllaveTipoSolicitud',$infoSiniestro->llaveTipoSolicitud,['class' => 'form-control form-control-sm llaveTipoSolicitud', 'id'=>'','hidden'=>'']) !!}
                                                    {!! Form::text('varllaveQuienSolicita',$infoSiniestro->llaveQuienSolicita,['class' => 'form-control form-control-sm llaveQuienSolicita', 'id'=>'llaveQuienSolicita','hidden'=>'']) !!}
                                                    {!! Form::text('usuarioReCali',$reClf->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoRecaCali','hidden'=>'']) !!}

                                                    <div class="row">
                                                        <div class="col-2 valorEntradaEdit" >
                                                            {!! Form::label('llaveCanalEntrada' , 'Canal entrada') !!}
                                                            <select class="form-control form-control-sm permisosSelect"  name="llaveCanalEntrada" id="permisosCanalEntrada" >
                                                                <option value="{{$infoSiniestro->id_entrada}}">{{$infoSiniestro->entrada}}</option>
                                                                @foreach  ($entradaPcl as $entrada)
                                                                <option value="{{$entrada -> id_entrada}}">{{$entrada -> entrada}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2 ocultar" id="divPqr">
                                                            {!! Form::label('pqr' , 'PQR') !!}
                                                            {!! Form::text('pqr',null,['class' => 'form-control form-control-sm permisosInput UpperCase','placeholder' => 'Pqr', 'id'=>'Pqr']) !!}
                                                        </div>
                                                        <div class="col-2 editQuienSolicita">
                                                            {!! Form::label('txtQuienSolicita' , 'Quien solicita') !!}
                                                            <select class="form-control form-control-sm permisosSelect"   name="llaveQuienSolicita" id="permisosQuienSolicita">
                                                            </select>
                                                        </div>  
                                                        <div class="col-2 ocultar" id="divOtro">
                                                            {!! Form::label('otros' , 'Otros') !!}
                                                            {!! Form::text('otros',null,['class' => 'form-control form-control-sm UpperCase permisosInput','placeholder' => 'Otros', 'id'=>'otros']) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div>
                                                        <div class="col-2" id="">
                                                            {!! Form::label('txtTipoSolicitud' , 'Tipo de solicitud') !!}
                                                            <select class="form-control form-control-sm permisosSelect"  name="llaveTipoSolicitud" required="" id="permisosTTSolicitud">
                                                                <option value="{{$infoSiniestro->id_solicitud}}">{{$infoSiniestro->solicitud}}</option>
                                                                @foreach  ($tipoSolicitud as $tipoSoli)
                                                                <option value="{{$tipoSoli -> id_solicitud}}">{{$tipoSoli -> solicitud}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            {!! Form::label('txtTipoEvento' , 'Tipo evento') !!}
                                                            <select class="form-control form-control-sm  permisosSelect"  name="llaveTipoEvento" id="permisosTiEvento">
                                                                <option value="{{$infoSiniestro->id_tipo_evento}}">{{$infoSiniestro->tipo_evento}}</option>
                                                                @foreach  ($tipoEvento as $evento)
                                                                <option value="{{$evento -> id_tipo_evento}}">{{$evento -> tipo_evento}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2 date">
                                                            {!! Form::label('fechaEvento' , 'Fecha del evento') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaEvento',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Fecha del evento' , 'id'=>'permisosEvento']) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-2">
                                                            {!! Form::label('fechaAsignacionDelCliente' , 'Fecha asig. cliente') !!}
                                                            <div class="input-group date">
                                                                {!! Form::text('fechaAsignacionDelCliente',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Fecha asignaciÃ³n cliente', 'id'=>'permisosCliente']) !!}
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                </div>
                                                            </div>                                 
                                                        </div> 
                                                        <div class="col-2">
                                                            {!! Form::label('idSiniestro' , 'Id Siniestro') !!}
                                                            {!! Form::text('idSiniestro',null,['class' => 'form-control form-control-sm solo_numero idSiniestroDesa permisosInput','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()']) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div>    

                                                        {!! Form::text('llaveListaPrecalificacion',null,['class' => 'form-control form-control-sm solo_numero', 'id'=>'requierePreCali','hidden' => '' ]) !!}
                                                        <div class="col-4" style="margin-left: -1%; display: none" id="requierePrecalificacion" >
                                                            <div class="card-body table-responsive pad">
                                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                    <label  class="btn btn-outline-success btn-sm" id="requierePreCalificacionSi">
                                                                        <input  onchange="javascript:showEditPreCali()" type="radio" name="llaveListaPrecalificacion" value="SI"   autocomplete="off"  id="permisosPreCalificacionSi">SI
                                                                    </label>
                                                                    <label  class="btn btn-outline-danger btn-sm" id="requierePreCalificacionNo">
                                                                        <input  onchange="javascript:noneEditPreCali()" type="radio" name="llaveListaPrecalificacion" value="NO"  autocomplete="off" id="permisosPreCalificacionNo">NO 
                                                                    </label>
                                                                    <label>&nbsp;&nbsp;Requiere PreCalificacion</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {!! Form::text('requiereValoracionPresencial',null,['class' => 'form-control form-control-sm solo_numero', 'id'=>'reValoPrese','hidden' => '' ]) !!}
                                                        <div class="col-4"  style="display: none" id="requiereMedicoValoracion">
                                                            <div class="card-body table-responsive pad"  style="margin-left: -6%">
                                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                    <label class="btn  btn-outline-success btn-sm " id="requiereValoracionSi">
                                                                        <input  type="radio" name="requiereValoracionPresencial"  value="SI" autocomplete="off"  id="permisosValoracionSi">SI
                                                                    </label>
                                                                    <label class="btn  btn-outline-danger btn-sm" id="requiereValoracionNo">
                                                                        <input   type="radio" name="requiereValoracionPresencial"  value="NO"  autocomplete="off"  id="permisosValoracionNo">NO
                                                                    </label>
                                                                    <label>&nbsp;&nbsp;Requiere val. presencial</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($infoSiniestro->llaveRecalificacion == null)
                                                        <div class="col-2 ocultar"  id="medicoRecalificacion" >
                                                            {!! Form::label('TxtAsignarA' , 'Asignar a') !!}
                                                            <select class="form-control form-control-sm permisosSelect" id="mediRecalifi" name="TxtAsignarARecaifi"  >
                                                                <option value="">Seleccionar</option>
                                                                @foreach  ($usuarios as $profe)
                                                                <option value="{{$profe -> id}}">{{$profe -> name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> 
                                                        @endif
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
                                                            <select class="form-control form-control-sm permisosSelect"  name="llaveTipoDocumento" id="permisosTiDocumento">
                                                                <option value="{{$infoSiniestro->id_tipo_docuemtno}}">{{$infoSiniestro->tipo_documento}}</option>
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
                                                        <div class="col-2">
                                                            {!! Form::label('direccionResi' , 'Direccion') !!}
                                                            {!! Form::text('direccionResi',null,['class' => 'form-control form-control-sm permisosInput','placeholder' => 'Direccion', 'id'=>'permisosDireccion']) !!}
                                                        </div>
                                                        <div class="col-2 departaEdit">
                                                            {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                                            <select class="form-control form-control-sm permisosSelect"  name="llaveDepartamento" id="permisosDepartamento">
                                                                <option value="{{$infoSiniestro->id_departamento}}">{{$infoSiniestro->departamento}}</option>
                                                                @foreach  ($departamento as $department)
                                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {!! Form::text('id_ciudad',null,['class' => 'form-control form-control-sm permisosInput ','placeholder' => 'Numero Documento','hidden'=>'','id'=>'ciuidadEdit']) !!}
                                                        <div class="col-2 ciuidadMostar">
                                                            {!! Form::label('txtDepartamento' , 'Ciudad') !!}
                                                            <select class="form-control form-control-sm  permisosSelect"  name="llaveCiudad" required="" id="">                                          
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
                                {!! Form::text('canalentradaA',$infoSiniestro->llaveCanalEntrada,['hidden'=>'']) !!}
                                {!! Form::text('quienSolicitaA',$infoSiniestro->llaveQuienSolicita,['hidden'=>'']) !!}
                                {!! Form::text('tipoSolicitudA',$infoSiniestro->llaveTipoSolicitud,['hidden'=>'']) !!}
                                {!! Form::text('tipoEventoA',$infoSiniestro->llaveTipoEvento,['hidden'=>'']) !!}
                                {!! Form::text('FechaEventoA',$infoSiniestro->fechaEvento,['hidden'=>'']) !!}
                                {!! Form::text('fechasAsiClienteA',$infoSiniestro->fechaAsignacionDelCliente,['hidden'=>'']) !!}
                                {!! Form::text('siniestroA',$infoSiniestro->idSiniestro,['hidden'=>'']) !!}
                                {!! Form::text('otrosA',$infoSiniestro->otros,['hidden'=>'']) !!}
                                {!! Form::text('pqrA',$infoSiniestro->pqr,['hidden'=>'']) !!}
                                <!--./==================================================================================-->
                                <!--./=========================== Datos basicos afiliado =================================================-->
                                {!! Form::text('tipoDocumentoA',$infoSiniestro->llaveTipoDocumento,['hidden'=>'']) !!}
                                {!! Form::text('numeroDocuentoA',$infoSiniestro->documento,['hidden'=>'']) !!}
                                {!! Form::text('nombreA',$infoSiniestro->nombre,['hidden'=>'']) !!}
                                {!! Form::text('direccionA',$infoSiniestro->direccionResi,['hidden'=>'']) !!}
                                {!! Form::text('departamentoA',$infoSiniestro->llaveDepartamento,['hidden'=>'']) !!}
                                {!! Form::text('ciudadA',$infoSiniestro->llaveCiudad,['hidden'=>'']) !!}
                                {!! Form::text('telefonoA',$infoSiniestro->telefono,['hidden'=>'']) !!}
                                {!! Form::text('numeroCelularA',$infoSiniestro->celular,['hidden'=>'']) !!}
                                {!! Form::text('correoA',$infoSiniestro->Correo,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('empresaA',$infoSiniestro->nit,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                {!! Form::text('modifica',Auth::user()->id,['hidden'=>'']) !!}
                                {!! Form::close() !!}
                            </div>
                            <!--./==================================================Datos =================================================-->
                            <div class="tab-pane" id="seguimientos">
                                <section class="content col-12">
                                    <br>
                                    <form method="POST" action="">
                                        <input type="hidden" name="TxtSiniestroPclSe" id="TxtSiniestroPclSe" value="{{$infoSiniestro->idSiniestroPcl}}" class="form-control form-control-sm ">
                                        <div id="recargar2"></div>
                                        <div class="row" id="CerrarDivSeguimiento" style="display: none">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Seguimiento</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            {!! Form::label('TxtSubEstado' , 'SubEstado') !!}
                                                            <select class="form-control form-control-sm "  name="TxtSubEstado" id="TxtSubEstado">
                                                                <option value="">Seleccionar</option>
                                                                @foreach  ($subEstadoSeguimiento as $subEstadoSgui)
                                                                <option value="{{$subEstadoSgui -> idSub_estado_seguimientos}}">{{$subEstadoSgui -> subEstadoSeguimiento}}</option>
                                                                @endforeach
                                                            </select>                                                                                                      
                                                        </div>                                                                                                 
                                                        <div class="col-2">
                                                            {!! Form::label('TxtRevisadoPor' , 'Revisado por') !!}
                                                            <input type="text" readonly="" value="{{ Auth::user()->name }}" class="form-control form-control-sm ">
                                                            <input type="hidden" name="TxtRevisadoPor" id="TxtRevisadoPor" value="{{ Auth::user()->id }}" class="form-control form-control-sm ">
                                                        </div>    
                                                        <!--  <div class="col-2" >
                                                              <button style="width: 140px; margin-top: 21px;" type="button" class="btn btn-block btn-outline-success btn-sm botones_letras" data-toggle="modal" data-target="#agenda">
                                                                  <i class="fas fa-calendar-alt"></i> Agendar cita
                                                              </button>
                                                          </div>-->
                                                        <div class="form-group col-12">
                                                            <label>Seguimiento</label>
                                                            <textarea  class="form-control" rows="3" name="TxtSeguimiento" id="TxtSeguimiento" placeholder="Seguimiento ..."></textarea>
                                                        </div> 
                                                    </div>
                                                    <button  type="button" id="btnGuardarSeguimiento" class="btn btn-outline-success btn-sm botones_letras"><i class = "fas fa-check-square fa-lg " >&nbsp;</i>Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row" >
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Seguimientos</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <input type="hidden" name="TxtSiniestroPcl" id="TxtSiniestroPcl" value="{{$infoSiniestro->idSiniestroPcl}}" class="form-control form-control-sm ">
                                                <div id="mostarSeguimientos"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!--==================================================Datos basicos empresa==================================================-->
                            <div class="tab-pane" id="diagnosticos">
                                {!! Form::hidden('sini',$infoSiniestro->idSiniestroPcl,['class' => 'form-control form-control-sm', 'id' =>'idSiniestroDxPcl' ]) !!}
                                <div class="card">
                                    <div class="card-body table-responsive pad">
                                        <div class="form-group col-sm-10 input-group-sm row" style="margin-left:0%;" id="permisoAgregarDiagnostico">
                                            <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " data-toggle="modal" data-target="#modalDiagnostico" >Agregar Diagnostico </button>
                                            </div>
                                        </div>  
                                        <div class="col-sm-12 col-md-12" id="ocultarTabla">
                                            <h5 style="margin-left: 45%"><b>Diagnosticos</b></h5>
                                            <div id="tablaCie10SiniestroPcl"></div>
                                        </div>                
                                    </div>
                                </div>
                            </div>
                            <!--==================================================Calificacion==================================================-->

                            <div class="tab-pane" id="calificacion">
                                <br>
                                @if($infoSiniestro->llaveCalificacion != NULL)
                                {!! Form::model($clf, ['route'=>['Calificacion.update',$clf->idCalifiacion], 'method'=>'put'])  !!}
                                @endif
                                <section class="content col-12">
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Calificacion</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">  
                                                    <?php $now = new \DateTime(); ?>
                                                    @if($clf->estado_siniestro == "TRAMITE ADMINISTRATIVO" && $clf->habilitado != 'SI' )
                                                    <div class="col-2" id="permisosHabilitar">
                                                        <div class="card-body table-responsive ">
                                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                <label  class="btn btn-outline-success btn-sm" id="requierePreCalificacionSi">
                                                                    <input  type="radio" name="habilitado" value="SI"   autocomplete="off">SI
                                                                </label>
                                                                <label  class="btn btn-outline-danger btn-sm" id="requierePreCalificacionNo">
                                                                    <input  type="radio" name="habilitado" value="NO"  autocomplete="off">NO 
                                                                </label>
                                                                <label>&nbsp;&nbsp;Habilitar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaAsignacionProfesionalCali != null)
                                                    <div class="col-3">
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha Asig. Profesional') !!}
                                                        <input value="{{$clf->fechaAsignacionProfesionalCali}}" readonly="" class="form-control form-control-sm permisosInputCali" name="">    
                                                    </div>
                                                    @endif
                                                    <div class="col-2">
                                                        {!! Form::label('llaveCalificadorCalifiacion' , 'Asignado a') !!}
                                                        <select class="form-control form-control-sm permisosSelectCaliObli"  name="llaveCalificadorCalifiacion" id="PermisosAsiganadoAcalificacion">
                                                            <option value="{{$clf->id}}">{{$clf->name}}</option>
                                                            @foreach  ($usuarios as $user)
                                                            <option value="{{$user -> id}}">{{$user -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                   
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveEstadoCalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosSelectCali"  name="llaveEstadoCalificacion" id="estadoCalificacion" required="">
                                                            <option value="{{$clf->id_estado_siniestro}}">{{$clf->estado_siniestro}}</option>
                                                            @if(Auth::user()->llaveRol_usuario != '12'  && Auth::user()->llaveRol_usuario != '15' && $clf -> estado_siniestro != 'ASIGNADO')
                                                            <option value="1">ASIGNADO</option>
                                                            @endif
                                                            @foreach  ($estadosCali as $estas)
                                                            <option value="{{$estas -> id_estado_siniestro}}">{{$estas -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-2 subEstadoCalificacion " id="DivSubEstadoCalificacion">
                                                        {!! Form::label('llaveSubEstadoCalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosSelectCali"  name="llaveSubEstadoCalificacion" id="subEstadoCalificacion">
                                                        </select> 
                                                    </div> 
                                                    {!! Form::text('no',$clf->llaveSubEstadoCalificacion,['class' => 'form-control form-control-sm','id'=>'subestadoMostarCali','hidden'=>""]) !!}
                                                    {!! Form::text('cerrado',$clf->sub_estados,['class' => 'form-control form-control-sm','id'=>'cerradoMedico','hidden'=>""]) !!}
                                                    {!! Form::text('calEstadoCerrado',$clf->estado_siniestro,['class' => 'form-control form-control-sm','id'=>'calEstadoCerrado','hidden'=>""]) !!}

                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveProcentajePcl' , 'Porcentaje Pcl') !!}
                                                        <input value="{{$clf->procentajePcl}}"  class="form-control form-control-sm PclValidacion permisosInputCali" name="procentajePcl"  placeholder="00,00" onkeypress="return filterFloat(event, this);">    
                                                    </div>

                                                    @if($clf->fechaEnvioComite != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaEnvioComite' , 'Fecha envio comite') !!}
                                                        <input value="{{$clf->fechaEnvioComite}}" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaEnvioComite" id="TxtFechaEnvioComite">    
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaEnvioComite == null)
                                                    <div class="col-2 ocultar" id="fechaEnvioComiteDiv" >
                                                        {!! Form::label('fechaEnvioComite' , 'Fecha envio comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaEnvioComite" id="TxtFechaEnvioComite">    
                                                    </div>
                                                    @endif


                                                    @if($clf->fechaDevolucionComite != null && $clf->fechaEnvioComite != null)
                                                    <div class="col-2 ocultar" id="fechaDevolucionComiteDiv" >
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha dev. comite') !!}
                                                        <input value="{{$clf->fechaDevolucionComite}}" readonly="" class="form-control form-control-sm permisosInputCali"  name="fechaDevolucionComite" id="TxtFechaDevolucionComite">    
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaDevolucionComite == null && $clf->fechaEnvioComite != null)
                                                    <div class="col-2 ocultar" id="fechaDevolucionComiteDiv" >
                                                        {!! Form::label('fechaDevolucionComite' , 'Fecha dev. comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaDevolucionComite" id="TxtFechaDevolucionComite">    
                                                    </div>
                                                    @endif


                                                    @if($clf->fechaVisado != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaVisado' , 'Fecha visado') !!}
                                                        <input value="{{$clf->fechaSolicitudAnexosCali}}" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaVisado" name="" id="TxtFechavisado">    
                                                    </div>
                                                    @endif @if($clf->fechaVisado == null)
                                                    <div class="col-2 ocultar" id="fechavisadoDiv" >
                                                        {!! Form::label('fechaVisado' , 'Fecha visado') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaVisado" id="TxtFechavisado">    
                                                    </div>
                                                    @endif

                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('fechaSolicitudAnexosCali' , 'Fecha Solicitud Anexos ') !!}
                                                        <input value="{{$clf->fechaSolicitudAnexosCali}}" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaSolicitudAnexosCali" id="">    
                                                    </div>
                                                    @endif
                                                    @if($clf->anexoCalificacion == null)
                                                    <div class="col-2 ocultar" id="fechaAnexoCalifiDiv" >
                                                        {!! Form::label('fechaSolicitudAnexosCali' , 'Fecha Solicitud Anexos ') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputCali" name="fechaSolicitudAnexosCali" id="TxtFechavisado">    
                                                    </div>
                                                    @endif

                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaSeguimientoAnexosCal' , 'Fecha seguimiento anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSeguimientoAnexosCal',null,['class' => 'form-control form-control-sm permisosInputCali','placeholder' => 'Fecha sequimiento anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaRecepcionAnexosCal' , 'Fecha recepcion anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRecepcionAnexosCal',null,['class' => 'form-control form-control-sm permisosInputCali','placeholder' => 'Fecha recepcion anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif

                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$clf->fechaGestionCali}}" readonly="" class="form-control form-control-sm permisosInputCali">    
                                                    </div>

                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="form-group col-12 ">
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="" class="form-control permisosInputCali" rows="3" name="anexoCalificacion" placeholder="Seguimiento ...">{{$clf->anexoCalificacion}}</textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoCali','NO',['class' => 'form-control form-control-sm','hidden'=>""]) !!}

                                                    @endif

                                                    @if($clf->anexoCalificacion == null)
                                                    <div class="form-group col-12 ocultar" id="divSolicitudAnexosCali" style="margin-top: 1%">
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="TxtSolicitudAnexoCali" class="form-control permisosInputCali" rows="3" name="anexoCalificacion"  placeholder="Seguimiento ..."></textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoCali','SI',['class' => 'form-control form-control-sm','hidden'=>""]) !!}

                                                    @endif


                                                    <div class="form-group col-12">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control permisosInputCali" rows="3" name="TxtObservacion" placeholder="Observaciones ..."></textarea>
                                                    </div>
                                                    <?php
                                                    $contador2 = 1;
                                                    if (count($caliObser)) {
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
                                                                                    <th width="20">NÂ°</th>
                                                                                    <th width="650">Observacion</th>    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                @foreach($caliObser as $obs)
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
                                                    {!! Form::text('idSiniestroPcl',$clf->idSiniestroPcl,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('documentoCorreo',$infoSiniestro->documento,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('NombreCorreo',$infoSiniestro->nombre,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('siniestroPcl',$infoSiniestro->idSiniestro,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}

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

                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('llaveCalificadorCalifiacionA',$clf->llaveCalificadorCalifiacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveEstadoCalificacionA',$clf->llaveEstadoCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveSubEstadoCalificacionA',$clf->llaveSubEstadoCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('procentajePclA',$clf->procentajePcl,['hidden'=>'']) !!}
                                {!! Form::text('fechaEnvioComiteA',$clf->fechaEnvioComite,['hidden'=>'']) !!}
                                {!! Form::text('fechaDevolucionComiteA',$clf->fechaDevolucionComite,['hidden'=>'']) !!}
                                {!! Form::text('fechaVisadoA',$clf->fechaVisado,['hidden'=>'']) !!}
                                {!! Form::text('fechaSolicitudAnexosCaliA',$clf->fechaSolicitudAnexosCali,['hidden'=>'']) !!}
                                {!! Form::text('anexoCalificacionA',$clf->anexoCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaSeguimientoAnexosCalA',$clf->fechaSeguimientoAnexosCal,['hidden'=>'']) !!}
                                {!! Form::text('fechaRecepcionAnexosCalA',$clf->fechaRecepcionAnexosCal,['hidden'=>'']) !!}

                                <!--./===================================================================================================-->
                                {!! Form::text('modificaCaliA',Auth::user()->id,['hidden'=>'']) !!}
                                {!! Form::text('caliSiniestro','Siniestro',['hidden'=>'']) !!}



                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane" id="preCalificacion">
                                <!--==================================================Datos =================================================-->
                                @if($infoSiniestro->llavePrecalificacion != NULL)
                                {!! Form::model($pre, ['route'=>['PreCalificacion.update',$pre->idPrecalificacion], 'method'=>'put'])  !!}
                                @endif                           
                                <section class="content col-12">
                                    <br>                                      
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>PreCalificacion</b></h3>
                                            </div>

                                            <div class="card-body">
                                                <div class="row">  
                                                    @if($pre->estado_siniestro == "TRAMITE ADMINISTRATIVO" && $pre->habilitaPre != 'SI' )
                                                    <div class="col-2" id="permisosHabilitarPreca">
                                                        <div class="card-body table-responsive ">
                                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                <label  class="btn btn-outline-success btn-sm" id="requierePreCalificacionSi">
                                                                    <input  type="radio" name="habilitaPre" value="SI"   autocomplete="off">SI
                                                                </label>
                                                                <label  class="btn btn-outline-danger btn-sm" id="requierePreCalificacionNo">
                                                                    <input  type="radio" name="habilitaPre" value="NO"  autocomplete="off">NO 
                                                                </label>
                                                                <label>&nbsp;&nbsp;Habilitar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($pre->fechaAsignacionProfesionalPreCali != null)
                                                    <div class="col-3">
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha Asig. Profesional') !!}
                                                        <input value="{{$pre->fechaAsignacionProfesionalPreCali}}" readonly="" class="form-control form-control-sm permisosInputPre" name="" >    
                                                    </div>
                                                    @endif
                                                    <div class="col-2">
                                                        {!! Form::label('llaveUsuarioAsigando' , 'Asignado a') !!}
                                                        <select class="form-control form-control-sm permisosSelectPreObli"  name="llaveCalificador" id="PermisosAsiganadoAPrecalificacion">
                                                            <option value="{{$pre->id}}">{{$pre->name}}</option>
                                                            @foreach  ($profesionalAsignar as $profe)
                                                            <option value="{{$profe -> id}}">{{$profe ->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                   
                                                    <div class="col-3 ">
                                                        {!! Form::label('llaveEstadoPrecalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosSelectPre"  name="llaveEstadoPrecalificacion" id="estadoPrecalificacio" required="">
                                                            <option value="{{$pre->id_estado_siniestro}}">{{$pre->estado_siniestro}}</option>
                                                            @if(Auth::user()->llaveRol_usuario != '12'  && Auth::user()->llaveRol_usuario != '15' && $pre -> estado_siniestro != 'ASIGNADO')
                                                            <option value="1">ASIGNADO</option>
                                                            @endif
                                                            @foreach  ($estadospre as $est)
                                                            <option value="{{$est -> id_estado_siniestro}}">{{$est -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-3 subEstadoPreCalificacion " id="mostarSubEstadPre">
                                                        {!! Form::label('llaveSubEstadoPrecalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosSelectPre" id="TxtSubEstadoId" name="llaveSubEstadoPrecalificacion" >
                                                        </select> 
                                                    </div> 
                                                    {!! Form::text('noaplica',$pre->llaveSubEstadoPrecalificacion,['class' => 'form-control form-control-sm', 'id'=>'subestadoSacar','hidden'=>'']) !!}
                                                    {!! Form::text('PreCerrado',$pre->sub_estados,['class' => 'form-control form-control-sm','id'=>'PreCerradoMedico','hidden'=>""]) !!}
                                                    {!! Form::text('PrEstadoCerrado',$pre->estado_siniestro,['class' => 'form-control form-control-sm','id'=>'prEstadoCerrado','hidden'=>""]) !!}

                                                    @if($pre->fechaSolicitudAnexos == null)
                                                    <div class="col-2  ocultar" id="fechaAnexosDiv" >
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha solicitud anexos') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputPre" name="fechaSolicitudAnexos">    
                                                    </div>
                                                    @endif
                                                    @if($pre->fechaSolicitudAnexos != null)
                                                    <div class="col-2  ocultar" id="fechaAnexosDiv" >
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha solicitud anexos') !!}
                                                        <input value="{{$pre -> fechaSolicitudAnexos}}" readonly="" class="form-control form-control-sm permisosInputPre" name="fechaSolicitudAnexos">    
                                                    </div>
                                                    @endif

                                                    @if($pre->anexoPreCalificacion != null)
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaSeguimientoAnexosPre' , 'Fecha seg. anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSeguimientoAnexosPre',null,['class' => 'form-control form-control-sm permisosInputPre','placeholder' => 'Fecha sequimiento anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaRecepcionAnexosPre' , 'Fecha recepcion anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRecepcionAnexosPre',null,['class' => 'form-control form-control-sm permisosInputPre','placeholder' => 'Fecha recepcion anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif
                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$pre->fechagestion}}" readonly="" class="form-control form-control-sm permisosInputPre">    
                                                    </div>

                                                    @if($pre->anexoPreCalificacion != null)
                                                    <div class="form-group col-12 " >
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="" class="form-control permisosInputPre" rows="3" name="anexoPreCalificacion" placeholder="Seguimiento ...">{{$pre->anexoPreCalificacion}}</textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvido','NO',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif

                                                    @if($pre->anexoPreCalificacion == null)
                                                    <div class="form-group col-12 ocultar " id="solicitudAnexosDiv" style="margin-top: 1%">
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="TxtSolicitudAnexosId" class="form-control permisosInputPre" rows="3" name="anexoPreCalificacion"  placeholder="Seguimiento ..."></textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvido','SI',['class' => 'form-control form-control-sm','hidden'=>""]) !!}

                                                    @endif
                                                    <div class="form-group col-12" style="margin-top: 1%">
                                                        <label>Analisis del caso</label>
                                                        <textarea id="permisosAnalisis" class="form-control permisosInputPre" required="" rows="3" name="TxtAnalisisCaso" placeholder="Analisis  del caso ..."></textarea>
                                                    </div>
                                                    <?php
                                                    $contador2 = 1;
                                                    if (count($preAnalisis)) {
                                                        ?>
                                                        <div class="col-12" style="margin-top: 1%;">
                                                            <div class="card direct-chat direct-chat-primary collapsed-card">
                                                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                                                    <h6 class="card-title">Analisis del caso</h6>
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
                                                                                    <th width="20">N</th>
                                                                                    <th width="650">Analisis</th>    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                @foreach($preAnalisis as $ana)
                                                                                <tr>
                                                                                    <td>{{$contador2}}</td>
                                                                                    <td>{{$ana -> analisis}}</td>
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
                                                    {!! Form::text('idSiniestroPcl',$pre->idSiniestroPcl,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('documentoCorreo',$infoSiniestro->documento,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('NombreCorreo',$infoSiniestro->nombre,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('siniestroPcl',$infoSiniestro->idSiniestro,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="bottonDatosPrecalificacion">
                                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success permisosBotton', 'id'=>'btnPrecalicicacionEnciarCorreo']) !!}
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('asigandoA',$pre->llaveCalificador,['hidden'=>'']) !!}
                                {!! Form::text('estadoA',$pre->llaveEstadoPrecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('subEstado',$pre->llaveSubEstadoPrecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaAnexos',$pre->fechaSolicitudAnexos,['hidden'=>'']) !!}
                                {!! Form::text('anexosA',$pre->anexoPreCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaRecep',$pre->fechaRecepcionAnexosPre,['hidden'=>'']) !!}
                                {!! Form::text('fechaSeguimiento',$pre->fechaSeguimientoAnexosPre,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                {!! Form::text('modifica',Auth::user()->id,['hidden'=>'']) !!}



                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane" id="recalificacion">
                                <!--==================================================Datos basicos empresa==================================================-->
                                @if($infoSiniestro->llaveRecalificacion != NULL)
                                {!! Form::model($reClf, ['route'=>['ReCalificacion.update',$reClf->idRecalificacionPcls], 'method'=>'put'])  !!}
                                @endif
                                <section class="content col-12">
                                    <br>                                      
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Recalificacion</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">  
                                                    @if($reClf->estado_siniestro == "TRAMITE ADMINISTRATIVO" && $reClf->habilitaReca != 'SI' )
                                                    <div class="col-2" id="permisosHabilitarPreca">
                                                        <div class="card-body table-responsive ">
                                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                <label  class="btn btn-outline-success btn-sm" id="requierePreCalificacionSi">
                                                                    <input class="permisosInput" type="radio" name="habilitaReca" value="SI"   autocomplete="off">SI
                                                                </label>
                                                                <label  class="btn btn-outline-danger btn-sm" id="requierePreCalificacionNo">
                                                                    <input class="permisosInput" type="radio" name="habilitaReca" value="NO"  autocomplete="off">NO 
                                                                </label>
                                                                <label>&nbsp;&nbsp;Habilitar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($reClf->fechaAsigProfesionalRecali != null)
                                                    <div class="col-2">
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha Asignacion') !!}
                                                        <input value="{{$reClf->fechaAsigProfesionalRecali}}" readonly="" class="form-control form-control-sm " name="">    
                                                    </div>
                                                    @endif
                                                    <div class="col-2">
                                                        {!! Form::label('llaveCalificadorRecalificacion' , 'Asignado a') !!}
                                                        <select class="form-control form-control-sm permisosSelectReCaliObli"  name="llaveCalificadorRecalificacion" required=""  id="PermisosAsiganadoARecalificacion" >
                                                            <option value="{{$reClf->id}}">{{$reClf->name}}</option>
                                                            @foreach  ($usuarios as $user)
                                                            <option value="{{$user -> id}}">{{$user -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                   
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveEstadoRecalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosSelectReCali"  name="llaveEstadoRecalificacion" id="EstadoRecalificacion" required="">
                                                            <option value="{{$reClf->id_estado_siniestro}}">{{$reClf->estado_siniestro}}</option>
                                                            @if(Auth::user()->llaveRol_usuario != '12'  && Auth::user()->llaveRol_usuario != '15' && $reClf -> estado_siniestro != 'ASIGNADO')
                                                            <option value="1">ASIGNADO</option>
                                                            @endif
                                                            @foreach  ($estadosReCali as $estRe)
                                                            <option value="{{$estRe -> id_estado_siniestro}}">{{$estRe -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    {!! Form::text('no',$reClf->llaveSubEstadoRecalificacion,['class' => 'form-control form-control-sm','id'=>'subestadoMostarReCali','hidden'=>'']) !!}
                                                    {!! Form::text('ReCerrado',$reClf->sub_estados,['class' => 'form-control form-control-sm','id'=>'ReCerradoMedico','hidden'=>""]) !!}
                                                    {!! Form::text('ReEstadoCerrado',$reClf->estado_siniestro,['class' => 'form-control form-control-sm','id'=>'ReEstadoCerrado','hidden'=>""]) !!}

                                                    <div class="col-2 subEstadoReCalificacion ">
                                                        {!! Form::label('llaveSubEstadoCalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosSelectReCali"  name="llaveSubEstadoRecalificacion" required="" id="subEstadoReCalificacion">
                                                        </select> 
                                                    </div> 
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveTipoEventoRecali' , 'Tipo Evento PCL') !!}
                                                        <select class="form-control form-control-sm permisosSelectReCali"  name="llaveTipoEventoRecali"  required="">
                                                            <option value="{{$reClf->id_tipo_evento}}">{{$reClf->tipo_evento}}</option>
                                                            @foreach  ($tipoEvento as $evento)
                                                            <option value="{{$evento -> id_tipo_evento}}">{{$evento -> tipo_evento}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaDictamenCalificacion' , 'Fecha Dictamen PCL ') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaDictamenCalificacion',null,['class' => 'form-control form-control-sm permisosInputReCali','placeholder' => 'Fecha Asignacion Profesional','required'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>

                                                    <div class="col-2" >
                                                        {!! Form::label('numeroDictamen' , 'N° dictamen') !!}
                                                        {!! Form::text('numeroDictamen',null,['class' => 'form-control form-control-sm solo_numero permisosInputReCali','required'=>'']) !!}
                                                    </div>


                                                    <div class="col-2" id="" >
                                                        {!! Form::label('entidadCalificaPcl' , 'Entidad que califica') !!}
                                                        <select class="form-control form-control-sm permisosSelectReCali"  name="entidadCalificaPcl" required="">
                                                            <option value="{{$reClf->entidadCalificaPcl}}">{{$reClf->entidadCalificaPcl}}</option>
                                                            @foreach  ($entididadCalifica as $enti)
                                                            <option value="{{$enti -> entidadCalificacol}}">{{$enti -> entidadCalificacol}}</option>
                                                            @endforeach
                                                        </select> 

                                                    </div>
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('procentajePclcalifi' , '% PCL inicial') !!}
                                                        {!! Form::text('procentajePclcalifi',$clf->procentajePcl,['class' => 'form-control form-control-sm permisosInputReCali','readonly'=>'']) !!}
                                                    </div>
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('porcentajePclRecalificacion' ,'% PCL recalificacion') !!}
                                                        {!! Form::text('porcentajePclRecalificacion',null,['class' => 'form-control form-control-sm PclValidacionRecali permisosInputReCali', 'placeholder'=>'00,00','required'=>'','onkeypress'=>'return filterFloatRecali(event, this);']) !!}
                                                    </div>

                                                    <!--==================================================fechaSolicitudAnexosRecali========================================================================-->
                                                    @if($reClf->fechaSolicitudAnexosRecali == null)
                                                    <div class="col-2 ocultar" id="divFechaAnexosReCali" >
                                                        {!! Form::label('fechaSolicitudAnexosRecali' , 'Fecha sol. Anexos') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaSolicitudAnexosRecali" id="TxtFechaAnexosReCali">    
                                                    </div>
                                                    @endif
                                                    @if($reClf->fechaSolicitudAnexosRecali != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaSolicitudAnexosRecali' , 'Fecha sol.Anexos') !!}
                                                        <input value="{{$reClf->fechaSolicitudAnexosRecali}}" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaSolicitudAnexosRecali">    
                                                    </div>
                                                    @endif
                                                    <!--==================================================fecha Solicitud AnexosRecali========================================================================-->
                                                    @if($reClf->fechaEnvioComiteRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaEnvioComiteRecalificacion' , 'Fecha envio comite') !!}
                                                        <input value="{{$reClf->fechaEnvioComiteRecalificacion}}" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaEnvioComiteRecalificacion">    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaEnvioComiteRecalificacion == null)
                                                    <div class="col-2 ocultar" id="divEnvioComiteRecai" >
                                                        {!! Form::label('fechaEnvioComiteRecalificacion' , 'Fecha envio comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaEnvioComiteRecalificacion" id="TxtFechaEnvioComiteRecali">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fecha Visado Recalificacion========================================================================-->
                                                    @if($reClf->fechaVisadoRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaVisadoRecalificacion' , 'Fecha visado') !!}
                                                        <input value="{{$reClf->fechaVisadoRecalificacion}}" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaVisadoRecalificacion" >    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaVisadoRecalificacion == null)
                                                    <div class="col-2 ocultar" id="divfechavisadoRecali" >
                                                        {!! Form::label('fechaVisadoRecalificacion' , 'Fecha visado') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" id="TxtfechavisadoRecali" class="form-control form-control-sm permisosInputReCali" name="fechaVisadoRecalificacion" id="">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fecha Devolcion Comite Recalificacion========================================================================-->
                                                    @if($reClf->fechaDevolcionComiteRecalificacion != null && $reClf->fechaEnvioComiteRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaDevolcionComiteRecalificacion' , 'Fecha dev. comite') !!}
                                                        <input value="{{$reClf->fechaDevolcionComiteRecalificacion}}" readonly="" class="form-control form-control-sm permisosInputReCali" name="fechaDevolcionComiteRecalificacion">    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaDevolcionComiteRecalificacion == null && $reClf->fechaEnvioComiteRecalificacion != null)
                                                    <div class="col-2 ocultar" id="divDevolucionComiteRecali" >
                                                        {!! Form::label('fechaDevolcionComiteRecalificacion' , 'Fecha dev. comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" id="TxtdevolucionComiteRecali" class="form-control form-control-sm permisosInputReCali" name="fechaDevolcionComiteRecalificacion" id="">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fechaSolicitudAnexosRecali========================================================================-->
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('numeroRadicacoSalida' ,'N° Radicado Salida') !!}
                                                        {!! Form::text('numeroRadicacoSalida',null,['class' => 'form-control form-control-sm permisosInputReCali']) !!}
                                                    </div>
                                                    @if($reClf->anexoReCalificacion != null)
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaSeguimientoAnexosRe' , 'Fecha seguimiento anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSeguimientoAnexosRe',null,['class' => 'form-control form-control-sm permisosInputReCali','placeholder' => 'Fecha sequimiento anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaRecepcionAnexosReCali' , 'Fecha recepcion anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRecepcionAnexosReCali',null,['class' => 'form-control form-control-sm permisosInputReCali','placeholder' => 'Fecha recepcion anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif
                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$reClf->fechaGestionReCali}}" readonly="" class="form-control form-control-sm permisosInputReCali" >    
                                                    </div>

                                                    @if($reClf->formatoNegacionRecalificacion == 'GENERADA')
                                                    <div class="col-2">   
                                                        <label></label>
                                                        <button type="button" class="btn btn-block btn-outline-danger btn-sm botones_letras" data-toggle="modal" data-target="#modal-xl">
                                                            <i class="fas fa-file-pdf"> Formatos</i>
                                                        </button>
                                                    </div>                         
                                                    @endif
                                                    @if($reClf->cartaNegacionRecalificacion == 'GENERADA')
                                                    <div class="col-2">   
                                                        <label></label>
                                                        <button type="button" class="btn btn-block btn-outline-danger btn-sm botones_letras" data-toggle="modal" data-target="#modal-cartas">
                                                            <i class="fas fa-file-pdf"> Cartas</i>
                                                        </button>
                                                    </div>                         
                                                    @endif

                                                    <div class="col-5">                                   
                                                        {!! Form::label('TxtCie10' , 'Dx cie 10') !!}
                                                        <div class="ui-widget">
                                                            <select  style="height: 28px" id="comboboxRecali" class="TxtIdDiagnosticoRec"  >
                                                                <option value=""></option>
                                                                @foreach  ($diagnosticos as $dig)
                                                                <option value="{{$dig -> id_cie_10}}">{{$dig -> id_ident}} {{$dig -> cie_10}}</option>
                                                                @endforeach                     
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-5">
                                                        <label>Descripcion diagnostico</label>
                                                        <textarea  class="form-control" rows="3"  disabled="" id="descripcionDiagnostico"  placeholder="DescripciÃ³n diagnÃ³stico ..."></textarea>
                                                    </div>

                                                    <div class="col-2">   
                                                        <label></label>
                                                        <button type="button"  disabled="" id="botondxReca" class="btn btn-block btn-outline-success btn-sm botones_letras" >
                                                            <i class="fas fa-plus fa-lg">&nbsp;</i>Agregar
                                                        </button>
                                                    </div> 

                                                    <div class="col-sm-12 col-md-12" id="">
                                                        <div id="tablaCie10reca"></div>
                                                    </div> 


                                                    @if($reClf->anexoReCalificacion != null)
                                                    <div class="form-group col-12 " >
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="" class="form-control permisosInputReCali" rows="3" name="" placeholder="Seguimiento ...">{{$reClf->anexoReCalificacion}}</textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoRecali','NO',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif
                                                    @if($reClf->anexoReCalificacion == null)
                                                    <div class="form-group col-12 ocultar" id="divSolicitudAnexosReCali" >
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="TxtSolicitudAnexosId" class="form-control permisosInputReCali" rows="3" name="anexoReCalificacion"  placeholder="Seguimiento ..."></textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoRecali','SI',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif
                                                    <div class="form-group col-12">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control permisosInputReCali" rows="3" name="TxtObservacionRecali" placeholder="Observaciones ..."></textarea>
                                                    </div>
                                                    <?php
                                                    $contador2 = 1;
                                                    if (count($caliObser)) {
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
                                                                                    <th width="20">NÂ°</th>
                                                                                    <th width="650">Observacion</th>    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                @foreach($obrrecali as $obs)
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
                                                    {!! Form::text('idSiniestroPcl',$reClf->idSiniestroPcl,['class' => 'form-control form-control-sm', 'hidden'=>'','id'=>'idSiniestDx']) !!}
                                                    {!! Form::text('documentoCorreo',$infoSiniestro->documento,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('NombreCorreo',$infoSiniestro->nombre,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('siniestroPcl',$infoSiniestro->idSiniestro,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}

                                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="permisosRecalificacionBotton">
                                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('llaveCalificadorRecalificacionA',$reClf->llaveCalificadorRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveEstadoRecalificacionA',$reClf->llaveEstadoRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveSubEstadoRecalificacionA',$reClf->llaveSubEstadoRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('llaveTipoEventoRecaliA',$reClf->llaveTipoEventoRecali,['hidden'=>'']) !!}
                                {!! Form::text('fechaDictamenCalificacionA',$reClf->fechaDictamenCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('numeroDictamenA',$reClf->numeroDictamen,['hidden'=>'']) !!}
                                {!! Form::text('entidadCalificaPclA',$reClf->entidadCalificaPcl,['hidden'=>'']) !!}
                                {!! Form::text('porcentajePclRecalificacionaA',$reClf->porcentajePclRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaEnvioComiteRecalificacionA',$reClf->fechaEnvioComiteRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaVisadoRecalificacionA',$reClf->fechaVisadoRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaDevolcionComiteRecalificacionA',$reClf->fechaDevolcionComiteRecalificacion,['hidden'=>'']) !!}
                                {!! Form::text('numeroRadicacoSalidaA',$reClf->numeroRadicacoSalida,['hidden'=>'']) !!}
                                {!! Form::text('fechaSolicitudAnexosRecaliA',$reClf->fechaSolicitudAnexosRecali,['hidden'=>'']) !!}
                                {!! Form::text('anexoReCalificacionA',$reClf->anexoReCalificacion,['hidden'=>'']) !!}
                                {!! Form::text('fechaRecepcionAnexosReCaliA',$reClf->fechaRecepcionAnexosReCali,['hidden'=>'']) !!}
                                {!! Form::text('fechaSeguimientoAnexosReA',$reClf->fechaSeguimientoAnexosRe,['hidden'=>'']) !!}

                                <!--./===================================================================================================-->
                                {!! Form::text('modificaReCaliA',Auth::user()->id,['hidden'=>'']) !!}



                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane" id="adicion">
                                <br>
                                <section class="content col-12">
                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;">
                                        <div class="col-md-3 col-sm-3 col-xs-12" id="ocultarCrearAdicion" >    
                                            <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " id="ocultarAdicion" >Crear Adicion</button>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">   
                                            <button type="button" class="btn btn-block btn-outline-warning botones_letras btn-sm" id="mostarAdicion">Ver Adciones</button>
                                        </div>
                                    </div>
                                </section>
                                <!-- ========================Mostra Adiciones por siniestro============================ -->
                                <section class="content col-12" id="ocultarTablaAdicion">
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Adiciones</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- ========================Mostra Adiciones por siniestro============================ -->
                                                <div class="row"  >  
                                                    <table  class="table table-stripped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Id Siniestro</th>
                                                                <th>Canal entrada</th>
                                                                <th>Fecha Asignacion</th>
                                                                <th>Documento Afiliado</th>
                                                                <th>Tipo de solicitud</th>
                                                                <th>Tipo evento</th>                                                 
                                                                <th>Estado</th>
                                                                <th>SubEstado</th>
                                                                <th>Asignado A</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody role="row" class="odd">
                                                            @foreach($adiciones as $adicion)
                                                            <tr>
                                                                <td>{{$adicion -> idAdicionPcl}}</td>
                                                                <td>{{$adicion -> idSiniestro}}</td>
                                                                <td>{{$adicion -> entrada}}</td> 
                                                                <td>{{$adicion -> fechaCreacioonAdicin}}</td> 
                                                                <td>{{$adicion -> documento}}</td>
                                                                <td>{{$adicion -> solicitud}}</td>
                                                                <td>{{$adicion -> tipo_evento}}</td>
                                                                <td>{{$adicion -> estado_siniestro}}</td>
                                                                <td>{{$adicion -> sub_estados}}</td>                                                             
                                                                <td>{{$adicion -> name}}</td>
                                                                <td>
                                                                    <div class="" >    
                                                                        <a type="button" href="/Adicion/{{$adicion->idAdicionPcl}}/edit" class="btn btn-block btn-outline-success btn-sm botones_letras "><i class="fas fa-edit"></i> Ver</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- ========================Fin Mostra Adiciones por siniestro============================ -->
                                <!-- ========================Crear Adiciones por siniestro============================ -->
                                <section class="content col-12" id="formularioPclAdicion" style="display: none">
                                    <div class="row" id="">
                                        <section class="content">
                                            {!! Form::open(['route' => 'crearAdicion.store', 'method' => 'POST']) !!}
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Ingrese los detalles de la Adicion</b></h3>
                                                </div>
                                                <div class="row">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-2 valorEntrada" >
                                                                {!! Form::label('txtCanalEntrada' , 'Canal entrada') !!}
                                                                <select class="form-control form-control-sm "  name="llaveCanalEntradaAdiPcl" required="" id="canalEntradaCrearAdicion">
                                                                    <option value="">Seleccionar</option>
                                                                    @foreach  ($entradaPcl as $entrada)
                                                                    <option value="{{$entrada -> id_entrada}}">{{$entrada -> entrada}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-2 ocultar" id="divPqrAdicion">
                                                                {!! Form::label('pqrAdicion' , 'PQR') !!}
                                                                {!! Form::text('pqrAdicion',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Pqr', 'id'=>'PqrAdicion']) !!}
                                                            </div>
                                                            <div class="col-2 queinSolicitaLista">
                                                                {!! Form::label('txtQuienSolicita' , 'Quien solicita') !!}
                                                                <select class="form-control form-control-sm"  name="LlaveQuienSoliAdiPcl" required="" id="quinSolicitaCrearAdicion">
                                                                </select>
                                                            </div>  
                                                            <div class="col-2 ocultar" id="divOtroAdicion">
                                                                {!! Form::label('otrosAdicion' , 'Otros') !!}
                                                                {!! Form::text('otrosAdicion',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Otros', 'id'=>'otrosAdicion']) !!}
                                                            </div>
                                                            <div class="col-2 ">
                                                                {!! Form::label('txtTipoSolicitud' , 'Tipo de solicitud') !!}
                                                                <select class="form-control form-control-sm"  name="LlavetipoSoliAdiPcl" disabled="">
                                                                    <option value="6">ADICION DE DX</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('e' , 'Tipo evento') !!}
                                                                {!! Form::text('e',$infoSiniestro->tipo_evento,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Tipo evento', 'readonly'=>'' ]) !!}
                                                            </div>
                                                            <div class="col-2 ">
                                                                {!! Form::label('ae' , 'Fecha del evento') !!}
                                                                {!! Form::text('ae',$infoSiniestro->fechaEvento,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Fecha del evento', 'readonly'=>'' ]) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('fechaAsigClienteAdiconPcl' , 'Fecha asig. cliente') !!}
                                                                <div class="input-group date">
                                                                    {!! Form::text('fechaAsigClienteAdiconPcl',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignaciÃ³n cliente','required'=>""]) !!}
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>                                 
                                                            </div> 
                                                            <div class="col-2">
                                                                {!! Form::label('idSiniestro' , 'Id Siniestro') !!}
                                                                {!! Form::text('idSiniestro',$infoSiniestro->idSiniestro,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Id Siniestro', 'readonly'=>'' ]) !!}
                                                                <div id="existeSiniestro"></div>
                                                            </div>                                          
                                                            <div class="col-2"  >
                                                                {!! Form::label('txtTipoEvento' , 'Asignar medico') !!}
                                                                <select class="form-control form-control-sm " required=""  name="llaveUsuarioAsigAdiPcl" >
                                                                    <option value="">Seleccionar</option>
                                                                    @foreach  ($medicoAsignar as $medi)
                                                                    <option value="{{$medi -> id}}">{{$medi -> name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                            {!! Form::text('llaveSiniestroAdicionPcl',$infoSiniestro->idSiniestroPcl,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Id Siniestro', 'readonly'=>'','hidden'=>'' ]) !!}
                                                            {!! Form::text('llaveUsuarioCreadorAdicion',Auth::user()->id,['class' => 'form-control form-control-sm ', 'id'=>'','hidden'=>'']) !!}
                                                        </div>
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </section>

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
                                                                {!! Form::text('tipo_documento',$infoSiniestro->tipo_documento,['class' => 'form-control form-control-sm','placeholder' => 'Numero Documento','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('documento' , 'Numero Documento') !!}
                                                                {!! Form::text('documento',$infoSiniestro->documento,['class' => 'form-control form-control-sm','placeholder' => 'Numero Documento','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-3">
                                                                {!! Form::label('nombre' , 'Nombre') !!}
                                                                {!! Form::text('nombre',$infoSiniestro->nombre,['class' => 'form-control form-control-sm','placeholder' => 'Nombre','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('direccionResi' , 'Direccion') !!}
                                                                {!! Form::text('direccionResi',$infoSiniestro->direccionResi,['class' => 'form-control form-control-sm','placeholder' => 'Direccion','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                                                {!! Form::text('txtDepartamento',$infoSiniestro->departamento,['class' => 'form-control form-control-sm','placeholder' => 'Direccion','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('telefono' , 'Telefono fijo') !!}
                                                                {!! Form::text('telefono',$infoSiniestro->telefono,['class' => 'form-control form-control-sm','placeholder' => 'Telefono fijo','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-2">
                                                                {!! Form::label('celular' , 'Numero celular') !!}
                                                                {!! Form::text('celular',$infoSiniestro->celular,['class' => 'form-control form-control-sm','placeholder' => 'Numero celular','readonly'=>'']) !!}
                                                            </div>
                                                            <div class="col-3">
                                                                {!! Form::label('Correo' , 'Correo') !!}
                                                                {!! Form::text('Correo',$infoSiniestro->Correo,['class' => 'form-control form-control-sm','placeholder' => 'Correo','readonly'=>'']) !!}
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
                                                                {!! Form::text('nit',$infoSiniestro->nit,['class' => 'form-control form-control-sm idSiniestroGestionAdicion','placeholder' => 'Correo', 'id' => 'idEmpleadorAdicion' ,'readonly'=>'']) !!}
                                                            </div> 
                                                            <!--=====================Campos Empresa Cargados=================================-->
                                                            <div class="row col-12" id="empresaSiExisteAdicion"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="">
                                            <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                            </div> 
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                </section>
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
                                                        $idsini = $infoSiniestro->idSiniestroPcl;
                                                        $sql5 = "SELECT 
                                                                    DATE(t.created_at) as fe
                                                                FROM
                                                                    tbl_trazas AS t
                                                                        INNER JOIN
                                                                    tbl_siniestro_pcls AS s ON s.idSiniestroPcl = t.llaveSiniestroPclUnion
                                                                    where llaveSiniestroPclUnion = $idsini
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
                                                                                    <th width="">MODIFICACIÃ“N</th>    
                                                                                    <th width="">INFORMACIÃ“N ANTERIOR</th>   
                                                                                    <th width="">INFORMACIÃ“N NUEVA</th>                                                                                
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody role="row" class="odd">
                                                                                <?php
                                                                                $sql = "SELECT
                                                                                           idSiniestro,
                                                                                           tipo,
                                                                                           anterior,
                                                                                           nuevo,
                                                                                           fecha_actualizacion,
                                                                                           name,
                                                                                           t.created_at as cuando
                                                                                       FROM
                                                                                           tbl_trazas AS t
                                                                                               INNER JOIN
                                                                                           tbl_siniestro_pcls AS s ON s.idSiniestroPcl = t.llaveSiniestroPclUnion
                                                                                               INNER JOIN
                                                                                           users AS u ON u.id = t.llaveUserPcTtraza
                                                                                       WHERE
                                                                                           llaveSiniestroPclUnion = $idsini
                                                                                               AND DATE(t.created_at) = '$fecha';";
                                                                                $result = mysqli_query($conexion1, $sql);
                                                                                while ($resultado = mysqli_fetch_array($result)) {
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $resultado["idSiniestro"]; ?></td>
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
@include('modal.modalDiagnostico') 
@include('modal.modalAgenda') 
@include('modal.modalCartas') 

@endsection

