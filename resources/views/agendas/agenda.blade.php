@extends('plantilla.templateAgenda')
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
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Agendas</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning"><i class="fas fa-user-md"></i> Medico</label>
                                            <div class="input-group input-group-sm">
                                                <select name="" id="doctor" class="form-control form-control-sm" required="">
                                                    <option value="0">Seleccionar</option>
                                                    @foreach  ($medico as $m)
                                                    <option value="{{$m->id}}">{{$m->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-append">
                                                    <button  id="AgendaDoc" class="btn btn-success btn-flat color_texto "><i class="fas fa-search"></i>  <b>Buscar</b></button>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>
                                    <img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
                                </div>
                                <div class="row">  
                                    <div class="form-group col-12">
                                        <div class="col-lg-11 text-center" style="margin-left: 35px;">
                                            <div id="calendar" class="col-centered">
                                            </div>
                                        </div>
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

@include('modal.modalAgenAdd') 
@include('modal.modalEditAgenda') 


@endsection

