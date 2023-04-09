<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formatos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">  
                        <div class="form-group col-12">
                            <table  class="table table-stripped table-bordered" id="">
                                <thead>
                                    <tr role="row">
                                        <th>Formato negación </th>
                                        <th>Fecha de creación  </th>
                                        <th>Elaboró</th>
                                    </tr>
                                </thead>    

                                <tbody role="row" class="odd">
                                    @foreach($cartas as $carta)
                                    <tr>
                                        <th><a   href="javascript:finestraSecundaria('/FormatoNegacion/{{$carta->idCartas}}')"  class="btn  btn-outline-danger btn-sm botones_letras"><i class="fas fa-file-pdf"></i> Formato negación</a></th>
                                        <th>{{$carta->fechaCreacion}}</th>
                                        <th>{{$carta->name}}</th>
                                    </tr>                              
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="/FormatoNegacion/{{$reClf->idSiniestroPcl}}/edit" class="btn  btn-outline-danger btn-sm botones_letras"><i class="fas fa-file-pdf"></i> Elaborar Formato</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-cartas">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formatos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">  
                        <div class="form-group col-12">
                            <table  class="table table-stripped table-bordered" id="">
                                <thead>
                                    <tr role="row">
                                        <th>Cartas negación</th>
                                        <th>Fecha de creación  </th>
                                        <th>Elaboró  </th>
                                    </tr>
                                </thead>    

                                <tbody role="row" class="odd">
                                    @foreach($cartasNegacion as $carta)
                                    <tr>
                                        <th><a   href="javascript:finestraSecundaria('/CartaNegacion/{{$carta->idCartaNegaciones}}')"  class="btn  btn-outline-danger btn-sm botones_letras"><i class="fas fa-file-pdf"></i> Formato negación</a></th>
                                        <th>{{$carta->fechaCreacion}}</th>
                                        <th>{{$carta->name}}</th>
                                    </tr>                              
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="/CartaNegacion/{{$reClf->idSiniestroPcl}}/edit" class="btn  btn-outline-danger btn-sm botones_letras"><i class="fas fa-file-pdf"></i> Elaborar Carta</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->