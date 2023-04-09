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
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Agenda</b></h3>
                            </div>
                            <div class="card-body">
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

@include('modal.modalShow') 


@endsection

