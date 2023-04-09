@extends('plantilla.template')
@section('tatle','app')

@section('formulario')

<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <section class="content col-12">
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-header car contornoTitulo">
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Informacion Medico</b></h3>
                            </div>
                            <div class="row">
                                <div class="card-body">
                                    <div class="col-12 " >
                                        {!! Form::model($medicoInfo, ['route'=>['GestionMedico.update',$medicoInfo->id], 'method'=>'put'])  !!}

                                        <div class="row">
                                            <div class="col-2 " >
                                                {!! Form::label('name' , 'Nombre Medico') !!}
                                                {!! Form::text('name',null,['class' => 'form-control form-control-sm ','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()']) !!}
                                            </div>
                                            <div class="col-2">
                                                {!! Form::label('email' , 'Email') !!}
                                                {!! Form::text('email',null,['class' => 'form-control form-control-sm ','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()']) !!}
                                            </div> 
                                            <div class="col-2">
                                                {!! Form::label('ciudad' , 'Ciudad') !!}
                                                {!! Form::text('ciudad',null,['class' => 'form-control form-control-sm ','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()']) !!}
                                            </div> 
                                            <div class="col-6">
                                                {!! Form::label('direccionConsultorio' , 'Direccion Consultorio') !!}
                                                {!! Form::text('direccionConsultorio',null,['class' => 'form-control form-control-sm ','placeholder' => 'Id Siniestro', 'id'=>'siniestroExis', 'onBlur'=>'comprobarSiniestro()']) !!}
                                            </div> 
                                            <div class="col-2">
                                                {!! Form::label('diponible' , 'Disponible') !!}
                                                <select class="form-control form-control-sm" name="diponible">
                                                    <option value="{{$medicoInfo->diponible}}">{{$medicoInfo->diponible}}</option>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                {!! Form::label('capacidad' , 'Capacidad') !!}
                                                {!! Form::text('capacidad',null,['class' => 'form-control form-control-sm']) !!}
                                            </div> 

                                            <div class="card-body col-12">
                                                <h6><b>Dias de atencion</b></h6>
                                                <div class="row text-center ">
                                                    <label for="lunes" class="btn btn-default colorBotonDias ">
                                                        Lunes
                                                        <input type="checkbox"   id="lunes"   class="badgebox "><span class="badge">&check;</span>
                                                    </label>
                                                    &nbsp;
                                                    <label for="martes" class="btn btn-default colorBotonDias">
                                                        Martes
                                                        <input type="checkbox" id="martes"  class="badgebox"><span class="badge">&check;</span>
                                                    </label>
                                                    &nbsp;
                                                    <label for="miercoles" class="btn btn-default colorBotonDias">
                                                        Miercoles
                                                        <input type="checkbox" id="miercoles"   class="badgebox"><span class="badge">&check;</span>
                                                    </label>
                                                    &nbsp;
                                                    <label for="jueves" class="btn btn-default colorBotonDias">
                                                        Jueves
                                                        <input  type="checkbox" id="jueves"  class="badgebox"><span class="badge">&check;</span>
                                                    </label>
                                                    &nbsp;
                                                    <label for="viernes" class="btn btn-default colorBotonDias">
                                                        Viernes
                                                        <input type="checkbox" id="viernes"   class="badgebox"><span class="badge">&check;</span>
                                                    </label>
                                                    &nbsp;
                                                    <label for="sabado" class="btn btn-default colorBotonDias">
                                                        Sabado
                                                        <input type="checkbox" id="sabado"  value="" class="badgebox"><span class="badge">&check;</span>
                                                    </label>
                                                    <input name="lunes" id="lunesTxt" value="" class="ocultar">
                                                    <input name="martes" id="martesTxt" value="" class="ocultar">
                                                    <input name="miercoles" id="miercolesTxt" value="" class="ocultar">
                                                    <input name="jueves" id="juevesTxt" value="" class="ocultar">
                                                    <input name="viernes" id="viernesTxt" value="" class="ocultar">
                                                    <input name="sabado" id="sabadoTxt" value="" class="ocultar">

                                                    <input name="" id="TxtLunes" value="{{$medicoInfo->lunes}}"  hidden="">
                                                    <input name="" id="TxtMartes" value="{{$medicoInfo->martes}}"  hidden="">
                                                    <input name="" id="Txtmiercoles" value="{{$medicoInfo->miercoles}}"  hidden="">
                                                    <input name="" id="TxtJueves" value="{{$medicoInfo->jueves}}"  hidden="">
                                                    <input name="" id="TxtViernes" value="{{$medicoInfo->viernes}}"  hidden="">
                                                    <input name="" id="TxtSabado" value="{{$medicoInfo->sabado}}"  hidden="">
                                                </div>
                                            </div>

                                            <div class="col-3" >
                                                {!! Form::label('diponible' , 'Horario de atención desde ') !!}
                                                <select class="form-control form-control-sm" id="hor" name="TxtDesde">
                                                    <option value="{{$horario->idHorasCitas}}">{{$horario->horaCita}}</option>
                                                    @foreach  ($horas as $hora)
                                                    <option value="{{$hora->idHorasCitas}}">{{$hora->horaCita}}</option>
                                                    @endforeach
                                                </select>
                                                <input name="TxtdesdeBase"  value="{{$horario->idHorasCitas}}" class="ocultar" >
                                                <input name="TxtHastaBase" id="TxtIdHOra" value="{{$horarioMax->idHorasCitas}}"  class="ocultar">
                                                <input name="" id="TxtHoraCita" value="{{$horarioMax->horaCita}}" class="ocultar">
                                            </div>
                                            <div class="col-3 horaHasta">
                                                {!! Form::label('diponible' , 'Horario de atención hasta') !!}
                                                <select class="form-control form-control-sm " name="Txthasta">
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;margin-top: 10px" id="">
                                                <div class="col-md-3 col-sm-3 col-xs-12" >    
                                                    {!! Form::submit('Guardar',['class' => 'botones_letras btn btn-block btn-outline-success']) !!}
                                                </div> 
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

