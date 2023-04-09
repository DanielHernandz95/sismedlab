<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_precalificaciones extends Model {

    protected $primaryKey = 'idPrecalificacion';
    protected $fillable = ['llaveCalificador', 'llaveEstadoPrecalificacion', 'llaveSubEstadoPrecalificacion', 'anexoPreCalificacion', 'fechaSolicitudAnexos', 'fechaSeguimientoAnexosPre', 'fechaRecepcionAnexosPre', 'puedoCalificar', 'fechaCierreCaso', 'fechaUltimaGestion', 'correoEnvido', 'habilitaPre', 'created_at', 'updated_at'];

}
