<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Modificar cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">                    
                    <div class="col-12"> 
                        <label>Medico</label>
                        <input type="text"  class="form-control form-control-sm" value="" id="medico" readonly>
                    </div>
                    <div class="col-12"> 
                        <label>Paciente</label>
                        <input type="text"  class="form-control form-control-sm" value="" id="paciente" readonly>
                    </div>
                    <div class="col-12"> 
                        <label>Tipo consulta</label>
                        <select class="form-control form-control-sm" name="TxtTipoConsulta" id="tipoConsulta">
                            @foreach($tipoConsultas as $tipoConsulta)
                            <option value="{{$tipoConsulta->idTipoConsulta}}">{{$tipoConsulta->tipoConsulta}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12"> 
                        <label>Dia cita</label>
                        <input type="text"  class="form-control form-control-sm" value="" id="diaCita" readonly>
                    </div>
                    <div class="col-12"> 
                        <label>Hora Cita</label>
                        <select class="form-control form-control-sm infHoraDisp" name="TxtHoraCita" id="hora">
                      
                        </select>
                    </div>    
                    
                    <div class="col-12"> 
                        <label>Ciudad</label>
                        <input type="text" class="form-control form-control-sm" value="" id="ciudad" readonly>
                    </div>
                    <div class="col-12"> 
                        <label>Direccion</label>
                        <input type="text"  class="form-control form-control-sm" value=""  id="direcc" readonly>
                    </div>
                    <br>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <button type="button" id="destroyCalendar" class="btn btn-outline-danger btn-sm botones_letras" data-dismiss="modal">Eliminar Evento</button>
                            </div>
                        </div>
                    </div>
                    <input  name="id" class="form-control" id="id" hidden="">
                    <input  name="" class="form-control" id="idmedico" hidden="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm botones_letras" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="editAgendaMedico"  class="btn btn-outline-success btn-sm botones_letras" data-dismiss="modal">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>