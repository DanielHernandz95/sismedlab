<div class="modal fade" id="modalDiagnostico">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DX CIE 10</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">                                   
                    {!! Form::label('Txtdiganos' , 'Origen diagnostico') !!}
                    <select class="form-control form-control-sm diga"   id="Txtdiganos" name="Txtdiganos"  required="" onChange="diga(this)" >
                        <option value="">Seleccionar</option>
                        @foreach  ($origenDiagnostico as $ori)
                        <option value="{{$ori->id_origen_diagnostico_adicional}}">{{$ori->origen}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">                                   
                    {!! Form::label('TxtCie10' , 'DX CIE 10') !!}
                    <div class="ui-widget">
                        <select  style="height: 28px" id="combobox" class="TxtIdDiagnostico"   >
                            <option value=""></option>
                            @foreach  ($diagnosticos as $dig)
                            <option value="{{$dig -> id_cie_10}}">{{$dig -> id_ident}} {{$dig -> cie_10}}</option>
                            @endforeach                     
                        </select>
                    </div>
                </div>
                <input  id="Txtid" name="Txtid"  type="hidden"  value="{{$infoSiniestroEl->id_elSiniestro}}" class="form-control c" onkeyup="mayus(this);"/>

                <div class="col-2" style="margin-left:  88%; margin-top: 2%" >
                    <button onclick="agregarProducto()" type="button" disabled="" id="boton" class="btn btn-outline-success btn-sm botones_letras"><i class="fas fa-plus fa-lg">&nbsp;</i>Agregar</button>
                </div>
            </div>

            <form method="POST" id="guardarDiagnosticosEl"  action="" accept-charset="utf-8">
                <div style="width: 96%; margin-left: 2%; margin-top: 1%">
                    <h6 style="margin-left: 35%"><b>CIE 10 SELECCIONADOS</b></h6>
                    <!-- Trigger the modal with a button -->
                    <table class="table table-bordered" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th width="150">Origen diagnóstico</th>
                                <th width="400">CIE 10</th>    
                                <th width="400">Descripción diagnóstico</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="ProSelected"><!--Ingreso un id al tbody-->
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-sm botones_letras" data-dismiss="modal">Cerrar</button>
                    <button onclick="recargarcieat()" type="submit" id="reca"  class="btn btn-outline-success btn-sm botones_letras"><i class = "fas fa-check-square fa-lg " >&nbsp;</i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function recargarcieat()
    {

    }
</script>