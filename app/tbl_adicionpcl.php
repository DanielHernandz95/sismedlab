<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_adicionpcl extends Model {

    protected $primaryKey = 'idAdicionPcl';
    protected $fillable = ['idAdicionPcl', 'llaveCanalEntradaAdiPcl', 'LlaveQuienSoliAdiPcl', 'LlavetipoSoliAdiPcl', 'llaveTipoEventoAdiPcl', 'fechaAsigClienteAdiconPcl', 'llaveSiniestroAdicionPcl', 'llaveUsuarioAsigAdiPcl', 'llaveCalificacionAdcion', 'llaveReCalificacionAdicion', 'llaveEstadoAdicion', 'llaveSubEstadoAdicion', 'fechaEventoAdcion', 'pqrAdicion', 'otrosAdicion', 'created_at', 'updated_at'];

}
