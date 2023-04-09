@extends('plantilla.template')
@section('tatle','app')

@section('formulario')

<?php

use Phppot\InformeAdicion;

/*
  use \Phppot\Product;
  use \Phppot\Consul_infor; */
require_once('dist/js/consultaInformes/adicion/informeAdicion.php');
error_reporting(0);


if (isset($_POST["exportAdicion"])) {
    $consul_infor = new InformeAdicion();
    $siniestros = $consul_infor->getAdicion();
    $consul_infor->exportsiniestrosAdicion($siniestros);
}
?>
<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <section class="content col-12">
                    <div class="row" id="seguimientoDiv">
                        <div class="card col-12">
                            <div class="card-header car contornoTitulo">
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Informe Adicion DX</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2 " id="valorEntradaInforme" >
                                        <label>Canal entrada</label>
                                        <select class="form-control form-control-sm "  name="canalEntrada" id="canalEntrada">
                                            <option value="">Seleccionar</option>
                                            @foreach  ($entradaPcl as $entrada)
                                            <option value="{{$entrada -> entrada}}">{{$entrada -> entrada}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2 " id="QuienSolicitainforme">
                                        <label>Quien solicita</label>
                                        <select class="form-control form-control-sm "   name="quienSolicita"  id="quienSolicita">
                                        </select>
                                    </div> 
                                    <div class="col-2 " >
                                        <label>Tipo de solicitud</label>
                                        <select class="form-control form-control-sm"  name="tipoSolicitud" id="tipoSolicitud">
                                            <option value="">Seleccionar</option>
                                            @foreach  ($tipoSolicitud as $tipoSoli)
                                            <option value="{{$tipoSoli->solicitud}}">{{$tipoSoli->solicitud}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2 " id="estadoInforme">
                                        <label>Estado</label>
                                        <select class="form-control form-control-sm"  name="estado"  id="estado">
                                            <option value="">Seleccionar</option>
                                            <option value="ASIGNADO">ASIGNADO</option>
                                            @foreach  ($estados as $estado)
                                            <option value="{{$estado->estado_siniestro}}">{{$estado->estado_siniestro}}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                    <div class="col-sm-2" id="subEstadoInforme" >
                                        <label>SubEstado</label>
                                        <select class="form-control form-control-sm"  name="subEstado" id="subEstado">
                                        </select>    
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Asigando a</label>
                                        <select class="form-control form-control-sm"  name="asignado"  id="asigando">
                                            <option value="">Seleccionar</option>
                                            @foreach  ($usuarios as $usuario)
                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                            @endforeach
                                        </select>                                        
                                    </div> 
                                    <div class="input-group col-sm-5 ">
                                        <div class="form-group">
                                            <label>Fecha Asignacion</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control form-control-sm" placeholder="Desde" name="fechaDesde" required="" id="fechaDesde">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label></label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control form-control-sm" placeholder="hasta" name="fechaHasta" required="" id="fechaHasta">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label></label>
                                        <button type="button"  class="btn btn-block btn-outline-success btn-sm botones_letras"  id="btnAdicion" ><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <label></label>
                                        <button type="submit" id="btnAdicionCompleto" name='exportAdicion'  class="btn btn-block btn-outline-warning btn-sm botones_letras"><i class="fas fa-file-excel fa-lg" ></i> Exportar base completa</button>
                                    </div> 
                                    <div id="exportGeneralFiltro" class="ocultar col-sm-2">
                                        <form action="" method="post">     
                                            @csrf
                                            <label></label>
                                            <button type="submit" id="" name='exportAdicion'  class="btn btn-block btn-outline-success btn-sm botones_letras"><i class="fas fa-file-excel fa-lg" ></i><b> EXPORTAR</b></button>
                                        </form>
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

