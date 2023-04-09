@extends('/home')
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
                                                        <button type="submit" class="btn btn-success btn-flat color_texto " onclick="comprobarUsuario()"><i class="fas fa-search"></i>  <b>Buscar</b></button>
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
                {!! Form::text('usuarioLoin',Auth::user()->llaveRol_usuario,['class' => 'form-control form-control-sm ', 'id'=>'rolUsuarioLoginActualinicio','hidden'=>'']) !!}
                <div id="estadousuario"></div> 
                <!--==================================================Datos =================================================-->
                @if(Auth::user()->llaveRol_usuario !=  15 && Auth::user()->llaveRol_usuario !=  12  ) 
                {!! Form::open(['route' => 'crearPcl.store', 'method' => 'POST']) !!}
                <div id="formularioPcl" style="display: none">
                    <section class="content col-12" >
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header car contornoTitulo">
                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Ingrese los detalles del siniestro</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 valorEntrada" >
                                            {!! Form::label('txtCanalEntrada' , 'Canal entrada') !!}
                                            <select class="form-control form-control-sm "  name="txtCanalEntrada" required="" id="canalEntradaCrear">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($entradaPcl as $entrada)
                                                <option value="{{$entrada -> id_entrada}}">{{$entrada -> entrada}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 ocultar" id="divPqr">
                                            {!! Form::label('txtPqr' , 'PQR') !!}
                                            {!! Form::text('txtPqr',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Pqr', 'id'=>'Pqr']) !!}
                                        </div>
                                        <div class="col-2 queinSolicitaLista">
                                            {!! Form::label('txtQuienSolicita' , 'Quien solicita') !!}
                                            <select class="form-control form-control-sm"  name="txtQuienSolicita" required="" id="quinSolicitaCrear">
                                            </select>
                                        </div>  
                                        <div class="col-2 ocultar" id="divOtro">
                                            {!! Form::label('otros' , 'Otros') !!}
                                            {!! Form::text('txtOtros',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Otros', 'id'=>'otros']) !!}
                                        </div>
                                        <div class="col-2 " id="">
                                            {!! Form::label('txtTipoSolicitud' , 'Tipo de solicitud') !!}
                                            <select class="form-control form-control-sm"  name="txtTipoSolicitud" required="" id="">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($tipoSolicitud as $tipoSoli)
                                                <option value="{{$tipoSoli -> id_solicitud}}">{{$tipoSoli -> solicitud}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            {!! Form::label('txtTipoEvento' , 'Tipo evento') !!}
                                            <select class="form-control form-control-sm "  name="txtTipoEvento" required="">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($tipoEvento as $evento)
                                                <option value="{{$evento -> id_tipo_evento}}">{{$evento -> tipo_evento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 date">
                                            {!! Form::label('TxtFechaEvento' , 'Fecha del evento') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaEvento',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha del evento', 'required'=>""]) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-2">
                                            {!! Form::label('TxtFechaAsignacionCliente' , 'Fecha asig. cliente') !!}
                                            <div class="input-group date">
                                                {!! Form::text('TxtFechaAsignacionCliente',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignación cliente','required'=>""]) !!}
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div>                                 
                                        </div> 
                                        <div class="col-2">
                                            {!! Form::label('txtIdSiniestro' , 'Id Siniestro') !!}
                                            {!! Form::text('txtIdSiniestro',null,['class' => 'form-control form-control-sm solo_numero','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()','required'=>""]) !!}
                                            <div id="existeSiniestro"></div>
                                        </div>                                          
                                        <div class="col-2" style="display: none" id="requiereProfesional">
                                            {!! Form::label('txtTipoEvento' , 'Asiganar profesional') !!}
                                            <select class="form-control form-control-sm " id="profesional" name="TxtAsignarA" >
                                                <option value="">Seleccionar</option>
                                                @foreach  ($profesionalAsignar as $profe)
                                                <option value="{{$profe -> id}}">{{$profe -> name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="col-2" style="display: none;" id="requiereMedico" >
                                            {!! Form::label('txtTipoEvento' , 'Asignar medico') !!}
                                            <select class="form-control form-control-sm " id="medico"  name="TxtAsignarA" >
                                                <option value="">Seleccionar</option>
                                                @foreach  ($medicoAsignar as $medi)
                                                <option value="{{$medi -> id}}">{{$medi -> name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="col-4" style="margin-left: -1%;" >
                                            <!-- <div class="icheck-success d-inline">
                                                 <input type="checkbox" name="TxtRPrecalifiacion" value="Si" id="preCalifiacion">
                                                 <label for="preCalifiacion">
                                                     Requiere PreCalificacion
                                                 </label>
                                             </div>-->
                                            <div class="card-body table-responsive pad">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label  class="btn  btn-outline-success btn-sm">
                                                        <input  onchange="javascript:showContent()" type="radio" name="TxtRPrecalifiacion" value="Si"   autocomplete="off" checked="">SI
                                                    </label>
                                                    <label  class="btn  btn-outline-danger btn-sm">
                                                        <input  onchange="javascript:noneContent()" type="radio" name="TxtRPrecalifiacion" value="No"  autocomplete="off">NO 
                                                    </label>
                                                    <label>&nbsp;&nbsp;Requiere PreCalificacion</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4" id="requiValo" style="display: none">
                                            <div class="card-body table-responsive pad"  style="margin-left: -7%">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn  btn-outline-success btn-sm" id="requiereValoracionSi">
                                                        <input onchange="javascript:showValoracion()" type="radio" name="TxtRequiereVal"  value="Si" autocomplete="off" checked="">SI
                                                    </label>
                                                    <label class="btn  btn-outline-danger btn-sm" id="requiereValoracionNo">
                                                        <input onchange="javascript:noneValoracion()" type="radio" name="TxtRequiereVal"  value="No"  autocomplete="off" checked="">NO
                                                    </label>
                                                    <label>&nbsp;&nbsp;Requiere val. presencial</label>
                                                </div>
                                            </div>
                                        </div>

                                        {!! Form::text('TxtUsuarioQuienCrea',Auth::user()->id,['class' => 'form-control form-control-sm ', 'hidden'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--==================================================Datos =================================================-->
                    <div style="display: none" id="requiereValoracion">
                        <section class="content col-12">
                            <div class="row">
                                <div class="card col-12">
                                    <div class="card-header car contornoTitulo">
                                        <h3 class="card-title letraTitulo" style="height: 5px;"><b>Valoracion</b></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 date">
                                                {!! Form::label('TxtFechaContactoAfiliado' , 'Fecha primer contacto') !!}
                                                <div class="input-group date">
                                                    {!! Form::text('TxtFechaContactoAfiliado',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignación cliente','id'=>'permisoRequiValoracion']) !!}
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-2">
                                                {!! Form::label('TxtSubEstado' , 'SubEstado') !!}
                                                <select class="form-control form-control-sm "  name="TxtSubEstado" id="subEstadoCita">
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
                                            <div class="col-2" id="divAgendarCita">
                                                <button style="width: 140px; margin-top: 21px;" type="button" class="btn btn-block btn-outline-success btn-sm botones_letras" data-toggle="modal" data-target="#agenda">
                                                    <i class="fas fa-calendar-alt"></i> Agendar cita
                                                </button>
                                            </div>
                                            <div id="agendaTraer"></div>  

                                            <div class="form-group col-12">
                                                <label>Seguimiento</label>
                                                <textarea  class="form-control" id="seguimientotext" rows="3" name="TxtSeguimiento" placeholder="Seguimiento ..." ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
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
                                            {!! Form::label('TxtTipoDocumento' , 'Tipo Documento') !!}
                                            <select class="form-control form-control-sm "  name="TxtTipoDocumento"  id="CrearAtipoCoduemtnoi">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($tipoDocumentoAfiliado as $tipoDocumenAfi)
                                                <option value="{{$tipoDocumenAfi->id_tipo_docuemtno}}">{{$tipoDocumenAfi->tipo_documento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            {!! Form::label('txtNumeroDocumento' , 'Numero Documento') !!}
                                            <input name="txtNumeroDocumento" class="form-control form-control-sm" id="cedula2" >
                                        </div>
                                        <div class="col-3">
                                            {!! Form::label('txtNombre' , 'Nombre') !!}
                                            {!! Form::text('txtNombre',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Nombre','id'=>'CrearANombre']) !!}
                                        </div>
                                        <div class="col-2">
                                            {!! Form::label('txtDireccion' , 'Direccion') !!}
                                            {!! Form::text('txtDireccion',null,['class' => 'form-control form-control-sm UpperCase','placeholder' => 'Direccion','id'=>'CrearADireccion']) !!}
                                        </div>
                                        <div class="col-2 departa">
                                            {!! Form::label('txtDepartamento' , 'Departamento') !!}
                                            <select class="form-control form-control-sm "  name="txtDepartamento"  id="CrearDepartamento">
                                                <option value="">Seleccionar</option>
                                                @foreach  ($departamento as $department)
                                                <option value="{{$department -> id_departamento}}">{{$department -> departamento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 ciuidadM">
                                            {!! Form::label('txtDepartamento' , 'Ciudad') !!}
                                            <select class="form-control form-control-sm ciuidadM"  name="llaveCiudad"  id="">                                          
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            {!! Form::label('txtTelefonoFijo' , 'Telefono fijo') !!}
                                            {!! Form::text('txtTelefonoFijo',null,['class' => 'form-control form-control-sm','placeholder' => 'Telefono fijo','id'=>'CrearTelefono']) !!}
                                        </div>
                                        <div class="col-2">
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
                    <div id="formularioBasicoAfiliadoLleno"></div>
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

@include('modal.modalAgendaInicio') 

@endsection

