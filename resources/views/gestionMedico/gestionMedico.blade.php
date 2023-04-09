@extends('plantilla.template')
@section('tatle','app')

@section('formulario')

<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <section class="content col-12">
                    <div class="row" id="seguimientoDiv">
                        <div class="card col-12">
                            <div class="card-header car contornoTitulo">
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Informacion Medicos</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <div class="form-group col-12">
                                        <table  class="table table-stripped table-bordered">
                                            <thead>
                                                <tr role="row">
                                                    <th>Id</th>
                                                    <th>Nombre Medico</th>
                                                    <th>Correo</th>
                                                    <th>Capacidad citas</th>
                                                    <th>Horario de atencion</th>
                                                    <th>Disponible</th>                                               
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody role="row" class="odd">
                                                @foreach($infoMedicoAgendas  as $medico)
                                                <tr role="row" class="odd">
                                                    <td>{{$medico->id}}</td>
                                                    <td>{{$medico->name}}</td>
                                                    <td>{{$medico->email}}</td>
                                                    <td>{{$medico->capacidad}}</td>
                                                    <td>@if($medico->lunes == 'SI')Lunes @endif  @if($medico->martes == 'SI')- Martes @endif  @if($medico->miercoles == 'SI') - Miercoles @endif 
                                                     @if($medico->jueves == 'SI') - Jueves @endif  @if($medico->viernes == 'SI') - Viernes @endif  @if($medico->sabado == 'SI')- Sabado @endif </td>
                                                    <td>{{$medico->diponible}}</td>
                                                    <td>
                                                        <div class="" >    
                                                            <a type="button" href="/GestionMedico/{{$medico->id}}/edit" class="btn btn-block btn-outline-success btn-sm botones_letras "><i class="fas fa-edit"></i> Ver</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {!! $infoMedicoAgendas->render()!!}
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

