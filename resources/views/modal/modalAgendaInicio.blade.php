


<div class="modal fade" id="agenda">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Agendar cita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-11 text-center" style="margin-left: 35px;">
                        <div id="calendar" class="col-centered">
                        </div>
                    </div>
                </div>
            </div>        
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-danger btn-sm botones_letras" data-dismiss="modal">Cerrar</button>
                <button  type="button"  class="btn btn-outline-success btn-sm botones_letras"><i class = "fas fa-check-square fa-lg " >&nbsp;</i>Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--=============================== /.modal Agendar cita  ============================= -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Agregar cita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12"> 
                            <label>Dia Cita</label>
                            <input type="text" name="" class="form-control form-control-sm prueba" id="start" readonly>
                        </div>
                        <div class="col-12"> 
                            <label>Tipo consulta</label>
                            <select class="form-control form-control-sm" name="TxtTipoConsulta" id="tipoConsult5a">
                                <option value="">Seleccionar</option>
                                @foreach($tipoConsultas as $tipoConsulta)
                                <option value="{{$tipoConsulta->idTipoConsulta}}">{{$tipoConsulta->tipoConsulta}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">                                   
                            {!! Form::label('Txtmedico' , 'Medico') !!}
                            <select class="form-control form-control-sm diga"   id="Txtmedico" name="Txtmedico"  required="" >
                                <option value="">Seleccionar</option>
                                @foreach  ($medico as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-12 ocultar" id="DivCampoAfiliadoExistente"> 
                            <label>Afiliaco</label>
                            <input type="text" name="" class="form-control form-control-sm " id="afiliadoAgendaComprobar" readonly>
                        </div>
                        <div class="col-12" id="infoMedico"></div>
                                                <div class="col-12" id="siTieneCita"></div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-sm botones_letras" data-dismiss="modal">Cerrar</button>
                    <button  type="button" id="btnPasardatos"  class="btn btn-outline-success btn-sm botones_letras" data-dismiss="modal"><i class = "fas fa-check-square fa-lg " >&nbsp;</i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

  
</script>

