<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_asignacion_cuida_uno extends Model {

    protected $primaryKey = 'idAsignacionCuidaUno';
    protected $fillable = ['idAsignacionCuidaUno', 'fechaRevicion', 'llaveAfiliacion', 'llaveCreado', 'fechaCreacion', 'llaveUsuarioResponsable', 'llaveEstadoInicial', 'llaveGestionRealizada', 'llaveEstadoTramite', 'llaveEstadoFinal', 'created_at', 'updated_at'];

}
