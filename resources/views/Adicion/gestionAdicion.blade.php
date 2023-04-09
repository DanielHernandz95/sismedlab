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
                            <li class="nav-item"><a class="nav-link active" href="#datosBasicos" data-toggle="tab">Datos Básicos</a></li>

                            <li class="nav-item"><a class="nav-link" href="#Adicion" data-toggle="tab">Adicion dx</a></li>
                            <li class="nav-item"><a class="nav-link" href="#diagnosticos" data-toggle="tab">Diagnósticos</a></li>
                            @if($infoSiniestro->llaveCalificacionAdcion != NULL && $infoSiniestro->llaveCalificacion == null)
                            <li class="nav-item"><a class="nav-link" href="#calificacion" data-toggle="tab">Calificación</a></li>
                            @endif
                            @if($infoSiniestro->llaveReCalificacionAdicion != NULL)
                            <li class="nav-item"><a class="nav-link" href="#recalificacion" data-toggle="tab">ReCalificación</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="#historial" data-toggle="tab">Historial</a></li>
                            <div class="col-md-1 col-sm-1 col-xs-12 atras" style="" >    
                                <a href="/Siniestro/{{$infoSiniestro->idSiniestroPcl}}/edit" type="button" class="btn btn-block btn-outline-success btn-sm botones_letras" >Atras</a>
                            </div>
                        </ul>
                    </div>
                    <div class="" style="background-color: #fff; ">
                        <div class="tab-content">
                            <div class="tab-pane active" id="datosBasicos">
                                {!! Form::text('usuarioRol',Auth::user()->llaveRol_usuario,['class' => 'form-control form-control-sm ', 'id'=>'validacionRol','hidden'=>'']) !!}
                                {!! Form::text('usuariocreador',$infoSiniestro->llaveUsuarioCreadorAdicion,['class' => 'form-control form-control-sm ', 'id'=>'usuarioCreador','hidden'=>'']) !!}
                                {!! Form::text('ausuariAsig',$infoSiniestro->llaveUsuarioAsigAdiPcl,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoPrecali','hidden'=>'']) !!}
                                {!! Form::text('usuarioLoin',Auth::user()->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioLoginActual','hidden'=>'']) !!}
                                {!! Form::text('usuarioCali',$clf->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoCali','hidden'=>'']) !!}
                                {!! Form::text('usuarioReCali',$reClf->id,['class' => 'form-control form-control-sm ', 'id'=>'usuarioAsignadoRecaCali','hidden'=>'']) !!}

                                {!! Form::model($infoSiniestro, ['route'=>['Adicion.update',$infoSiniestro->idAdicionPcl], 'method'=>'put'])  !!}
                                <br>
                                <div id="" >
                                    <section class="content col-12" >
                                        <div class="row">
                                            <div class="card col-12">
                                                <div class="card-header car contornoTitulo">
                                                    <h3 class="card-title letraTitulo" style="height: 5px;"><b>Detalles del siniestro</b></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        {!! Form::text('varllaveQuienSolicita',$infoSiniestro->LlaveQuienSoliAdiPcl,['class' => 'form-control form-control-sm llaveQuienSolicita', 'id'=>'llaveQuienSolicita','hidden'=>'']) !!}

                                                        <div class="col-2 valorEntradaEdit" >
                                                            {!! Form::label('txtCanalEntrada' , 'Canal entrada') !!}
                                                            <select class="form-control form-control-sm permisosAdiSelect"  name="llaveCanalEntradaAdiPcl" required="" id="permisosCanalEntrada">
                                                                <option value="{{$infoSiniestro->id_entrada}}">{{$infoSiniestro->entrada}}</option>
                                                                @foreach  ($entradaPcl as $entrada)
                                                                <option value="{{$entrada->id_entrada}}">{{$entrada->entrada}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2 ocultar" id="divPqr">
                                                            {!! Form::label('pqrAdicion' , 'PQR') !!}
                                                            {!! Form::text('pqrAdicion',null,['class' => 'form-control form-control-sm UpperCase permisosAdiInput','placeholder' => 'Pqr', 'id'=>'Pqr']) !!}
                                                        </div>
                                                        <div class="col-2 editQuienSolicita">
                                                            {!! Form::label('txtQuienSolicita' , 'Quien solicita') !!}
                                                            <select class="form-control form-control-sm permisosAdiSelect"   name="LlaveQuienSoliAdiPcl" id="permisosQuienSolicita">
                                                            </select>
                                                        </div>       
                                                        <div class="col-2 ocultar" id="divOtroAdicion">
                                                            {!! Form::label('otrosAdicion' , 'Otros') !!}
                                                            {!! Form::text('otrosAdicion',null,['class' => 'form-control form-control-sm UpperCase permisosAdiInput','placeholder' => 'Otros', 'id'=>'otrosAdicion']) !!}
                                                            <div id="existeSiniestro"></div>
                                                        </div>
                                                        <div class="col-2 ">
                                                            {!! Form::label('txtTipoSolicitud' , 'Tipo de solicitud') !!}
                                                            <select class="form-control form-control-sm "  name="LlavetipoSoliAdiPcl" disabled="">
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
                                                                {!! Form::text('fechaAsigClienteAdiconPcl',null,['class' => 'form-control form-control-sm','placeholder' => 'Fecha asignación cliente','required'=>""]) !!}
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
                                                            {!! Form::text('nit',null,['class' => 'form-control form-control-sm idSiniestroGestion','placeholder' => 'Correo', 'id' => 'idEmpleador','readonly'=>'' ]) !!}
                                                        </div> 
                                                        <!--=====================Campos Empresa Cargados=================================-->
                                                        <div class="row col-12" id="empresaSiExiste"></div>
                                                        <div class="row col-12" id="empresasMasPorNit"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="btnDatosAdi">
                                        <div class="col-md-3 col-sm-3 col-xs-12" >    
                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                        </div> 
                                    </div>
                                </div>


                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('llaveCanalEntradaAdiPclA',$infoSiniestro->llaveCanalEntradaAdiPcl,['hidden'=>'']) !!}
                                {!! Form::text('LlaveQuienSoliAdiPclA',$infoSiniestro->LlaveQuienSoliAdiPcl,['hidden'=>'']) !!}
                                {!! Form::text('fechaAsigClienteAdiconPclA',$infoSiniestro->fechaAsigClienteAdiconPcl,['hidden'=>'']) !!}
                                {!! Form::text('pqrAdicionA',$infoSiniestro->pqrAdicion,['hidden'=>'']) !!}
                                {!! Form::text('otrosAdicionA',$infoSiniestro->otrosAdicion,['hidden'=>'']) !!}

                                <!--./===================================================================================================-->
                                {!! Form::text('modificaAdicion',Auth::user()->id,['hidden'=>'']) !!}
                                {!! Form::close() !!}
                            </div>

                            <!--./==================================================Adicion Dx =================================================-->
                            <div class="tab-pane" id="Adicion">
                                {!! Form::model($infoSiniestro, ['route'=>['Adicion.update',$infoSiniestro->idAdicionPcl], 'method'=>'put'])  !!}
                                <section class="content col-12">
                                    <br>                                      
                                    <div class="row" id="">
                                        <div class="card col-12">
                                            <div class="card-header car contornoTitulo">
                                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Adicion Dx</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">  
                                                    @if($infoSiniestro->fechaCreacioonAdicin != null)
                                                    <div class="col-2">
                                                        {!! Form::label('fechaCreacioonAdicin' , 'Fecha Asig. Profesional') !!}
                                                        <input value="{{$infoSiniestro->fechaCreacioonAdicin}}" readonly="" class="form-control form-control-sm permisosAdiInputPre" name="" >    
                                                    </div>
                                                    @endif
                                                    <div class="col-2"  >
                                                        {!! Form::label('txtTipoEvento' , 'Asignar a') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectPreObli" required=""  name="llaveUsuarioAsigAdiPcl" >
                                                            <option value="{{$infoSiniestro->id}}">{{$infoSiniestro->name}}</option>
                                                            @foreach  ($medicoAsignar as $medi)
                                                            <option value="{{$medi -> id}}">{{$medi -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> 
                                                    {!! Form::text('noaplica',$infoSiniestro->llaveSubEstadoAdicion,['class' => 'form-control form-control-sm', 'id'=>'subestadoSacar','hidden'=>'']) !!}
                                                    <div class="col-3 ">
                                                        {!! Form::label('llaveEstadoPrecalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectPre"  name="llaveEstadoAdicion" id="estadoPrecalificacio" required="">
                                                            <option value="{{$infoSiniestro->id_estado_siniestro}}">{{$infoSiniestro->estado_siniestro}}</option>
                                                            @foreach  ($estados as $est)
                                                            <option value="{{$est -> id_estado_siniestro}}">{{$est -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-3 subEstadoPreCalificacion ">
                                                        {!! Form::label('llaveSubEstadoPrecalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectPre" id="TxtSubEstadoId" name="llaveSubEstadoAdicion" >
                                                        </select> 
                                                    </div> 
                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$infoSiniestro->fechaGestionAdicion}}" readonly="" class="form-control form-control-sm permisosAdiInputPre">    
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control permisosAdiInputPre" rows="3" name="TxtObservacion" placeholder="Observaciones ..."></textarea>
                                                    </div>
                                                    <?php
                                                    $contador2 = 1;
                                                    if (count($obserAdicion)) {
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
                                                                                @foreach($obserAdicion as $obs)
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
                                                    {!! Form::text('pclCalificacion',$infoSiniestro->llaveCalificacion,['class' => 'form-control form-control-sm llaveQuienSolicita','hidden'=>'']) !!}
                                                    {!! Form::text('AdiCalificacion',$infoSiniestro->llaveCalificacionAdcion,['class' => 'form-control form-control-sm llaveQuienSolicita', 'id'=>'','hidden'=>'']) !!}
                                                    {!! Form::text('AdiReCalificacion',$infoSiniestro->llaveReCalificacionAdicion,['class' => 'form-control form-control-sm llaveQuienSolicita', 'id'=>'','hidden'=>'']) !!}

                                                    <div class="col-12" style="margin-left:34%;" id="btnAdicionDx">
                                                        <div class="col-2" >    
                                                            <label></label>
                                                            {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success', 'id'=>'btnPrecalicicacionEnciarCorreo']) !!}
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--./================================================== Datos basicos afiliado =================================================-->
                                {!! Form::text('llaveEstadoAdicionA',$infoSiniestro->llaveEstadoAdicion,['hidden'=>'']) !!}
                                {!! Form::text('llaveSubEstadoAdicionA',$infoSiniestro->llaveSubEstadoAdicion,['hidden'=>'']) !!}
                                {!! Form::text('llaveUsuarioAsigAdiPclA',$infoSiniestro->llaveUsuarioAsigAdiPcl,['hidden'=>'']) !!}
                                <!--./===================================================================================================-->
                                {!! Form::text('modificaAdicion',Auth::user()->id,['hidden'=>'']) !!}


                                {!! Form::close() !!}
                            </div>
                            <!--./==================================================Diagnosticos =================================================-->
                            <div class="tab-pane" id="diagnosticos">
                                {!! Form::hidden('sini',$infoSiniestro->idAdicionPcl,['class' => 'form-control form-control-sm', 'id' =>'idAdicionPcl' ]) !!}
                                <div class="card">
                                    <div class="card-body table-responsive pad">
                                        <div class="form-group col-sm-10 input-group-sm row" style="margin-left:0%;" id="permisoAgregarDiagnosticoAdici">
                                            <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " data-toggle="modal" data-target="#modalDiagnostico" >Agregar Diagnóstico </button>
                                            </div>
                                        </div>  
                                        <div class="col-sm-12 col-md-12" id="ocultarTabla">
                                            <h5 style="margin-left: 45%"><b>Diagnósticos</b></h5>
                                            <div id="tablaCie10SiniestroPclAdicines"></div>
                                        </div>                
                                    </div>
                                </div>
                            </div>
                            <!--==================================================Datos basicos empresa==================================================-->
                            <div class="tab-pane" id="calificacion">
                                <br>
                                @if($infoSiniestro->llaveCalificacionAdcion != NULL)
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
                                                    <div class="col-2">
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha Asig. Profesional') !!}
                                                        <input value="{{$clf->fechaAsignacionProfesionalCali}}" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="">    
                                                    </div>
                                                    @endif
                                                    <div class="col-2">
                                                        {!! Form::label('llaveCalificadorCalifiacion' , 'Asignado a') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectCaliObli "  name="llaveCalificadorCalifiacion" id="PermisosAsiganadoAcalificacion">
                                                            <option value="{{$clf->id}}">{{$clf->name}}</option>
                                                            @foreach  ($usuarios as $user)
                                                            <option value="{{$user -> id}}">{{$user -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                   
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveEstadoCalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectCali"  name="llaveEstadoCalificacion" id="estadoCalificacion" required="">
                                                            <option value="{{$clf->id_estado_siniestro}}">{{$clf->estado_siniestro}}</option>
                                                            @foreach  ($estadosCali as $est)
                                                            <option value="{{$est -> id_estado_siniestro}}">{{$est -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-2 subEstadoCalificacion ">
                                                        {!! Form::label('llaveSubEstadoCalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectCali"  name="llaveSubEstadoCalificacion" required="" id="subEstadoCalificacion">
                                                        </select> 
                                                    </div> 
                                                    {!! Form::text('no',$clf->llaveSubEstadoCalificacion,['class' => 'form-control form-control-sm','id'=>'subestadoMostarCali','hidden'=>""]) !!}
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveProcentajePcl' , 'Porcentaje Pcl') !!}
                                                        <input value="{{$clf->procentajePcl}}"  class="form-control form-control-sm PclValidacion permisosAdiInputCali" name="procentajePcl"  placeholder="00,00" onkeypress="return filterFloat(event, this);">    
                                                    </div>

                                                    @if($clf->fechaEnvioComite != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaEnvioComite' , 'Fecha envio comité') !!}
                                                        <input value="{{$clf->fechaEnvioComite}}" readonly="" class="form-control form-control-sm permisosAdiInputCali"  name="fechaEnvioComite" id="TxtFechaEnvioComite">    
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaEnvioComite == null)
                                                    <div class="col-2 ocultar" id="fechaEnvioComiteDiv" >
                                                        {!! Form::label('fechaEnvioComite' , 'Fecha envio comité') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaEnvioComite" id="TxtFechaEnvioComite">    
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaDevolucionComite != null)
                                                    <div class="col-2 ocultar" id="fechaDevolucionComiteDiv" >
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha dev. comité') !!}
                                                        <input value="{{$clf->fechaDevolucionComite}}" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaDevolucionComite" id="TxtFechaDevolucionComite">    
                                                    </div>
                                                    @endif
                                                    @if($clf->fechaDevolucionComite == null)
                                                    <div class="col-2 ocultar" id="fechaDevolucionComiteDiv" >
                                                        {!! Form::label('fechaDevolucionComite' , 'Fecha dev. comité') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaDevolucionComite" id="TxtFechaDevolucionComite">    
                                                    </div>
                                                    @endif


                                                    @if($clf->fechaVisado != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaVisado' , 'Fecha visado') !!}
                                                        <input value="{{$clf->fechaSolicitudAnexosCali}}" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaVisado" id="TxtFechavisado">    
                                                    </div>
                                                    @endif @if($clf->fechaVisado == null)
                                                    <div class="col-2 ocultar" id="fechavisadoDiv" >
                                                        {!! Form::label('fechaVisado' , 'Fecha visado') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaVisado" id="TxtFechavisado">    
                                                    </div>
                                                    @endif

                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('fechaSolicitudAnexosCali' , 'Fecha Solicitud Anexos ') !!}
                                                        <input value="{{$clf->fechaSolicitudAnexosCali}}" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaSolicitudAnexosCali" id="TxtFechavisado">    
                                                    </div>
                                                    @endif
                                                    @if($clf->anexoCalificacion == null)
                                                    <div class="col-2 ocultar" id="fechaAnexoCalifiDiv" >
                                                        {!! Form::label('fechaSolicitudAnexosCali' , 'Fecha Solicitud Anexos ') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputCali" name="fechaSolicitudAnexosCali" id="TxtFechavisado">    
                                                    </div>
                                                    @endif
                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaSeguimientoAnexosCal' , 'Fecha seguimiento anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSeguimientoAnexosCal',null,['class' => 'form-control form-control-sm permisosAdiInputCali','placeholder' => 'Fecha sequimiento anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaRecepcionAnexosCal' , 'Fecha recepcion anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRecepcionAnexosCal',null,['class' => 'form-control form-control-sm permisosAdiInputCali','placeholder' => 'Fecha recepcion anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif

                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$clf->fechaGestionCali}}" readonly="" class="form-control form-control-sm permisosAdiInputCali">    
                                                    </div>

                                                    @if($clf->anexoCalificacion != null)
                                                    <div class="form-group col-12 ">
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="" class="form-control permisosAdiInputCali" rows="3" name="anexoCalificacion" placeholder="Seguimiento ...">{{$clf->anexoCalificacion}}</textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoCali','NO',['class' => 'form-control form-control-sm','hidden'=>""]) !!}

                                                    @endif

                                                    @if($clf->anexoCalificacion == null)
                                                    <div class="form-group col-12 ocultar" id="divSolicitudAnexosCali" style="margin-top: 1%">
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="TxtSolicitudAnexoCali permisosAdiInputCali" class="form-control" rows="3" name="anexoCalificacion"  placeholder="Seguimiento ..."></textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoCali','SI',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif
                                                    <div class="form-group col-12">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control permisosAdiInputCali" rows="3" name="TxtObservacion" placeholder="Observaciones ..."></textarea>
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
                                                                                    <th width="20">N°</th>
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
                                                    {!! Form::text('idSiniestroPcl',$clf->idAdicionPcl,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
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
                                {!! Form::text('caliSiniestro','AdicionTraza',['hidden'=>'']) !!}

                                {!! Form::close() !!}
                            </div>



                            <div class="tab-pane" id="recalificacion">
                                <!--==================================================Datos basicos empresa==================================================-->
                                @if($infoSiniestro->llaveReCalificacionAdicion != NULL)
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
                                                                    <input  type="radio" name="habilitaReca" value="SI"   autocomplete="off">SI
                                                                </label>
                                                                <label  class="btn btn-outline-danger btn-sm" id="requierePreCalificacionNo">
                                                                    <input  type="radio" name="habilitaReca" value="NO"  autocomplete="off">NO 
                                                                </label>
                                                                <label>&nbsp;&nbsp;Habilitar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($reClf->fechaAsigProfesionalRecali != null)
                                                    <div class="col-2">
                                                        {!! Form::label('fechaSolicitudAnexos' , 'Fecha Asig. Profesional') !!}
                                                        <input value="{{$reClf->fechaAsigProfesionalRecali}}" readonly="" class="form-control form-control-sm permisosInput" name="">    
                                                    </div>
                                                    @endif
                                                    <div class="col-2">
                                                        {!! Form::label('llaveCalificadorRecalificacion' , 'Asignado a') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectReCaliObli"  name="llaveCalificadorRecalificacion" required=""  id="PermisosAsiganadoARecalificacion" >
                                                            <option value="{{$reClf->id}}">{{$reClf->name}}</option>
                                                            @foreach  ($usuarios as $user)
                                                            <option value="{{$user -> id}}">{{$user -> name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                   
                                                    <div class="col-2 ">
                                                        {!! Form::label('llaveEstadoRecalificacion' , 'Estado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectReCali"  name="llaveEstadoRecalificacion" id="EstadoRecalificacion" required="">
                                                            <option value="{{$reClf->id_estado_siniestro}}">{{$reClf->estado_siniestro}}</option>
                                                            @foreach  ($estadosReCali as $estRe)
                                                            <option value="{{$estRe -> id_estado_siniestro}}">{{$estRe -> estado_siniestro}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    {!! Form::text('no',$reClf->llaveSubEstadoRecalificacion,['class' => 'form-control form-control-sm','id'=>'subestadoMostarReCali','hidden'=>'']) !!}
                                                    <div class="col-2 subEstadoReCalificacion ">
                                                        {!! Form::label('llaveSubEstadoCalificacion' , 'SubEstado') !!}
                                                        <select class="form-control form-control-sm permisosAdiSelectReCali"  name="llaveSubEstadoRecalificacion" required="" id="subEstadoReCalificacion">
                                                        </select> 
                                                    </div> 
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaDictamenCalificacion' , 'Fecha Dictamen PCL ') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaDictamenCalificacion',null,['class' => 'form-control form-control-sm permisosAdiInputReCali','placeholder' => 'Fecha Asignacion Profesional','required'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-2 "  >
                                                        {!! Form::label('numeroDictamen' , 'N° dictamen') !!}
                                                        {!! Form::text('numeroDictamen',null,['class' => 'form-control form-control-sm solo_numero permisosAdiInputReCali','required'=>'']) !!}
                                                    </div>

                                                    <div class="col-2" id="" >
                                                        {!! Form::label('entidadCalificaPcl' , 'Entidad que califica') !!}
                                                        <select class="form-control form-control-sm permisosInputReCali"  name="entidadCalificaPcl" required="">
                                                            <option value="{{$reClf->entidadCalificaPcl}}">{{$reClf->entidadCalificaPcl}}</option>
                                                            @foreach  ($entididadCalifica as $enti)
                                                            <option value="{{$enti -> entidadCalificacol}}">{{$enti -> entidadCalificacol}}</option>
                                                            @endforeach
                                                        </select> 

                                                    </div>
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('procentajePclcalifi' , '% PCL inicial') !!}
                                                        {!! Form::text('procentajePclcalifi',$clf->procentajePcl,['class' => 'form-control form-control-sm permisosAdiInputReCali','readonly'=>'']) !!}
                                                    </div>
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('porcentajePclRecalificacion' ,'% PCL recalificacion') !!}
                                                        {!! Form::text('porcentajePclRecalificacion',null,['class' => 'form-control form-control-sm PclValidacionRecali permisosAdiInputReCali', 'placeholder'=>'00,00', 'onkeypress'=>'return filterFloatRecali(event, this);']) !!}
                                                    </div>



                                                    <!--==================================================fechaSolicitudAnexosRecali========================================================================-->
                                                    @if($reClf->fechaSolicitudAnexosRecali == null)
                                                    <div class="col-2 ocultar" id="divFechaAnexosReCali" >
                                                        {!! Form::label('fechaSolicitudAnexosRecali' , 'Fecha solicitud Anexos') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputReCali" name="fechaSolicitudAnexosRecali" id="TxtFechaAnexosReCali">    
                                                    </div>
                                                    @endif
                                                    @if($reClf->fechaSolicitudAnexosRecali != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaSolicitudAnexosRecali' , 'Fecha solicitud Anexos') !!}
                                                        <input value="{{$reClf->fechaSolicitudAnexosRecali}}" readonly="" class="form-control form-control-sm permisosAdiInputReCali"  name="fechaSolicitudAnexosRecali">    
                                                    </div>
                                                    @endif
                                                    <!--==================================================fecha Solicitud AnexosRecali========================================================================-->
                                                    @if($reClf->fechaEnvioComiteRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaEnvioComiteRecalificacion' , 'Fecha envio comite') !!}
                                                        <input value="{{$reClf->fechaEnvioComiteRecalificacion}}" readonly="" class="form-control form-control-sm permisosAdiInputReCali" name="fechaEnvioComiteRecalificacion">    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaEnvioComiteRecalificacion == null)
                                                    <div class="col-2 ocultar" id="divEnvioComiteRecai" >
                                                        {!! Form::label('fechaEnvioComiteRecalificacion' , 'Fecha envio comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" class="form-control form-control-sm permisosAdiInputReCali" name="fechaEnvioComiteRecalificacion" id="TxtFechaEnvioComiteRecali">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fecha Visado Recalificacion========================================================================-->
                                                    @if($reClf->fechaVisadoRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaVisadoRecalificacion' , 'Fecha visado') !!}
                                                        <input value="{{$reClf->fechaVisadoRecalificacion}}" readonly="" class="form-control form-control-sm permisosAdiInputReCali" name="fechaVisadoRecalificacion">    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaVisadoRecalificacion == null)
                                                    <div class="col-2 ocultar" id="divfechavisadoRecali" >
                                                        {!! Form::label('fechaVisadoRecalificacion' , 'Fecha visado') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" id="TxtfechavisadoRecali" class="form-control form-control-sm permisosAdiInputReCali" name="fechaVisadoRecalificacion" id="">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fecha Devolcion Comite Recalificacion========================================================================-->
                                                    @if($reClf->fechaDevolcionComiteRecalificacion != null)
                                                    <div class="col-2 " >
                                                        {!! Form::label('fechaDevolcionComiteRecalificacion' , 'Fecha dev. comite') !!}
                                                        <input value="{{$reClf->fechaDevolcionComiteRecalificacion}}" readonly="" name="fechaDevolcionComiteRecalificacion" class="form-control form-control-sm permisosAdiInputReCali" >    
                                                    </div> 
                                                    @endif
                                                    @if($reClf->fechaDevolcionComiteRecalificacion == null)
                                                    <div class="col-2 ocultar" id="divDevolucionComiteRecali" >
                                                        {!! Form::label('fechaDevolcionComiteRecalificacion' , 'Fecha dev. comite') !!}
                                                        <input value="<?php echo $now->format('Y-m-d H:i:s'); ?>" readonly="" id="TxtdevolucionComiteRecali" class="form-control form-control-sm permisosAdiInputReCali" name="fechaDevolcionComiteRecalificacion" id="">    
                                                    </div> 
                                                    @endif
                                                    <!--==================================================fechaSolicitudAnexosRecali========================================================================-->
                                                    <div class="col-2 " id="" >
                                                        {!! Form::label('numeroRadicacoSalida' ,'N° Radicado Salida') !!}
                                                        {!! Form::text('numeroRadicacoSalida',null,['class' => 'form-control form-control-sm permisosAdiInputReCali']) !!}
                                                    </div>
                                                    @if($reClf->anexoReCalificacion != null)
                                                    <div class="col-3 date">
                                                        {!! Form::label('fechaSeguimientoAnexosRe' , 'Fecha seguimiento anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaSeguimientoAnexosRe',null,['class' => 'form-control form-control-sm permisosAdiInputReCali','placeholder' => 'Fecha sequimiento anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-2 date">
                                                        {!! Form::label('fechaRecepcionAnexosReCali' , 'Fecha recepcion anexos') !!}
                                                        <div class="input-group date">
                                                            {!! Form::text('fechaRecepcionAnexosReCali',null,['class' => 'form-control form-control-sm permisosAdiInputReCali','placeholder' => 'Fecha recepcion anexos' , 'id'=>'']) !!}
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif
                                                    <div class="col-2"  >
                                                        {!! Form::label('updated_at' , 'Fecha Gestion') !!}
                                                        <input value="{{$reClf->fechaGestionReCali}}" readonly="" class="form-control form-control-sm permisosAdiInputReCali" >    
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
                                                        <label>Descripción diagnóstico</label>
                                                        <textarea  class="form-control" rows="3"  disabled="" id="descripcionDiagnostico"  placeholder="Descripción diagnóstico ..."></textarea>
                                                    </div>

                                                    <div class="col-2">   
                                                        <label></label>
                                                        <button type="button"  disabled="" id="botondxRecaAdicion" class="btn btn-block btn-outline-success btn-sm botones_letras" >
                                                            <i class="fas fa-plus fa-lg">&nbsp;</i>Agregar
                                                        </button>
                                                    </div>  

                                                    <div class="col-sm-12 col-md-12" id="">
                                                        <div id="tablaCieRecaliAdicioon"></div>
                                                    </div> 




                                                    @if($reClf->anexoReCalificacion != null)
                                                    <div class="form-group col-12 " >
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="" class="form-control permisosAdiInputReCali" rows="3" name="" placeholder="Seguimiento ...">{{$reClf->anexoReCalificacion}}</textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoRecali','NO',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif
                                                    @if($reClf->anexoReCalificacion == null)
                                                    <div class="form-group col-12 ocultar" id="divSolicitudAnexosReCali" >
                                                        <label>Solicitud anexos</label>
                                                        <textarea id="TxtSolicitudAnexosId" class="form-control permisosAdiInputReCali" rows="3" name="anexoReCalificacion"  placeholder="Seguimiento ..."></textarea>
                                                    </div>
                                                    {!! Form::text('correoEnvidoRecali','SI',['class' => 'form-control form-control-sm','hidden'=>""]) !!}
                                                    @endif
                                                    <div class="form-group col-12">
                                                        <label>Observaciones</label>
                                                        <textarea  class="form-control permisosAdiInputReCali" rows="3" name="TxtObservacionRecali" placeholder="Observaciones ..."></textarea>
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
                                                                                    <th width="20">N°</th>
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
                                                    {!! Form::text('idSiniestroPcl',$reClf->idAdicionPcl,['class' => 'form-control form-control-sm', 'hidden'=>'']) !!}
                                                    {!! Form::text('documentoCorreo',$infoSiniestro->documento,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('NombreCorreo',$infoSiniestro->nombre,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('siniestroPcl',$infoSiniestro->idSiniestro,['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}
                                                    {!! Form::text('siEsAdicion','ADICION',['class' => 'form-control form-control-sm','placeholder' => 'Fecha Asignacion Profesional','hidden'=>""]) !!}

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
                                                        $idsini = $infoSiniestro->idAdicionPcl;
                                                        $sql5 = "SELECT 
                                                                    DATE(t.created_at) as fe
                                                                FROM
                                                                    tbl_trazas AS t
                                                                        INNER JOIN
                                                                    tbl_adicionpcls AS s ON s.idAdicionPcl = t.llaveAdicionPclUnion
                                                                    where llaveAdicionPclUnion = $idsini
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
                                                                                           tbl_adicionpcls AS a ON a.idAdicionPcl = t.llaveAdicionPclUnion
                                                                                                INNER join
                                                                                            tbl_siniestro_pcls AS s ON s.idSiniestroPcl = a.llaveSiniestroAdicionPcl
                                                                                               INNER JOIN
                                                                                           users AS u ON u.id = t.llaveUserPcTtraza
                                                                                       WHERE
                                                                                           llaveAdicionPclUnion = $idsini
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

@include('modal.modalDiagnosticoAdicion') 
@include('modal.modalCartasAdicion') 

@endsection

