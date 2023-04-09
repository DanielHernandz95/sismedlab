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
                                        {!! Form::model($medicoInfo, ['route'=>['GestionUsuarios.update',$medicoInfo->id], 'method'=>'put'])  !!}

                                        <div class="row">
                                            <div class="col-3 " >
                                                {!! Form::label('name' , 'Nombre Medico') !!}
                                                {!! Form::text('name',null,['class' => 'form-control form-control-sm ','placeholder' => '', 'id'=>'', 'readonly'=>'']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Form::label('email' , 'Email') !!}
                                                {!! Form::text('email',null,['class' => 'form-control form-control-sm ','placeholder' => '', 'id'=>'', 'readonly'=>'']) !!}
                                            </div> 
                                            
                                            <div class="col-2">
                                                {!! Form::label('capacidad' , 'Capacidad') !!}
                                                {!! Form::text('capacidadBandejaCasos',null,['class' => 'form-control form-control-sm']) !!}
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

