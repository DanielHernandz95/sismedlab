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
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Solicitud de documentos</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <div class="form-group col-12">
                                        <table  class="table table-stripped table-bordered" id="Cartas">
                                            <thead>
                                                <tr role="row">
                                                    <th >Id</th>
                                                    <th>Id Siniestro</th>
                                                    <th>Canal entrada</th>
                                                    <th>Fecha Asignacion</th>
                                                    <th>Documento Afiliado</th>
                                                    <th>Tipo de solicitud</th>
                                                    <th>Tipo evento</th>                                                 
                                                    <th>Estado</th>
                                                    <th>SubEstado</th>
                                                    <th>Tipo gestion</th>
                                                    <th>Asignado A</th>
                                                    <th></th>
                                                    <th style="width: 5px;"></th>
                                                </tr>
                                            </thead>                                        
                                        </table>
                                        
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

