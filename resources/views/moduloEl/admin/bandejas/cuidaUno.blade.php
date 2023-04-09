@extends('./plantilla.templateEl')
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
                                <h3 class="card-title letraTitulo" style="height: 5px;"><b>Bandeja Cuida uno</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <div class="form-group col-12">
                                        <table  class="table table-stripped table-bordered" id="cuida">
                                            <thead>
                                                <tr role="row">
                                                    <th>Id</th>
                                                    <th>Id Siniestro</th>
                                                    <th>Canal entrada</th>
                                                    <th>Marcacion Covid</th>
                                                    <th>Fecha Asignacion</th>
                                                    <th>Documento Afiliado</th>
                                                    <th>Tipo de solicitud</th>
                                                    <th></th>
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

