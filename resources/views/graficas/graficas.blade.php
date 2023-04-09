@extends('plantilla.template')
@section('tatle','app')

@section('formulario')

<div class="content-wrapper"> 
    <div class="card-body">  
        <div class="row">
            <div class="col-12">
                <section class="content col-12">
                    <div class="row" >
                        <div class="card col-12">
                            <div class="card-header car contornoTitulo">
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Dashboard por mes </b></h3>
                            </div>

                            <div class="card-header p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#productividad" data-toggle="tab">Consuta de Productividad </a></li>
                                    <li class="nav-item"><a class="nav-link" href="#quienSsolicita" data-toggle="tab">volúmenes de radicación quien solicita</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tipoSolicitud" data-toggle="tab">volúmenes de radicación tipo solicitud </a></li>
                                    <li class="nav-item"><a class="nav-link" href="#PorMes" data-toggle="tab">Por mes</a></li>

                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="productividad" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="input-group col-sm-6 ">
                                                    <div class="form-group">
                                                        <label>Fecha a consultar</label>
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control form-control-sm" placeholder="Desde" name="fechaDesde" required="" id="fechaDesdePorMes">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label></label>
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control form-control-sm" placeholder="hasta" name="fechaHasta" required="" id="fechaHastaPorMes">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label></label>
                                                    <button type="button" name="BtnFiltroPorMas"  class="btn btn-block btn-outline-success btn-sm botones_letras"  id="btnFiltroPorMas" ><i class="fas fa-search"></i> Consultar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                    <div id="porMesUno"></div>
                                    <div id="porMesDos"></div>
                                    <div id="porMesEmpresas"></div>
                                    <div id="indicadorMensual"></div>

                                </div>

                                <div class="tab-pane fade" id="quienSsolicita" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">

                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 " >
                                                <label>Quien solicita</label>
                                                <select class="form-control form-control-sm "  name="quienSolicita" id="quienSolicita">
                                                    <option value="">Seleccionar</option>
                                                    @foreach  ($quienSolicita as $quien)
                                                    <option value="{{$quien -> quien_solicita}}">{{$quien ->quien_solicita }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6 ">
                                                <div class="form-group">
                                                    <label>Periodo a consultar</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Desde" name="fechaDesde" required="" id="fechaDesdeQuien">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label></label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control form-control-sm" placeholder="hasta" name="fechaHasta" required="" id="fechaHastaQuien">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label></label>
                                                <button type="button" name="btnFiltroQuienSolicita"  class="btn btn-block btn-outline-success btn-sm botones_letras"  id="btnFiltroQuienSolicita" ><i class="fas fa-search"></i> Buscar</button>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="quienSoliMostrar"></div>
                                </div>

                                <div class="tab-pane fade  " id="tipoSolicitud" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 "  >
                                                <label>Tipo de solicitud</label>
                                                <select class="form-control form-control-sm "  name="tipoSolicitud" id="tipoSolicitudse">
                                                    <option value="">Seleccionar</option>
                                                    @foreach  ($tipoSolicitud as $tipo)
                                                    <option value="{{$tipo -> solicitud}}">{{$tipo -> solicitud }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <div class="form-group">
                                                    <label>Periodo a consultar</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Desde" name="fechaDesde" required="" id="fechaDesdeTipo">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label></label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control form-control-sm" placeholder="hasta" name="fechaHasta" required="" id="fechaHastaTipo">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label></label>
                                                <button type="button" name="BtnFiltroTipoSolicitud"  class="btn btn-block btn-outline-success btn-sm botones_letras"  id="BtnFiltroTipoSolicitud" ><i class="fas fa-search"></i> Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tipoSolicitudMostr"></div>
                                </div>


                                <div class="tab-pane fade  " id="PorMes" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            @include('graficas.graficasSinConsulta.volumenRadicacion') <!--  Grafica 4-->
                                            @include('graficas.graficasSinConsulta.casosNoPertinentes') <!--  Grafica 7-->
                                            @include('graficas.graficasSinConsulta.casosGestionados') <!--  Grafica 8-->
                                            @include('graficas.graficasSinConsulta.asignandoVrsCuantosSeHanGestionado') <!--  Grafica 9-->
                                            @include('graficas.graficasSinConsulta.asignadoVrsAvalado') <!--  Grafica 9-->
                                            @include('graficas.graficasSinConsulta.avaladoPCl') <!--  Grafica 9-->
                                        </div>
                                    </div>                                 
                                </div>                              
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </section>



            </div>
        </div>
    </div>
</div>


@endsection

