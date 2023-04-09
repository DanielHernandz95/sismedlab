<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_horario_atencion_medico extends Model {

    protected $fillable = ['llaveCiudadAtencionMedico', 'direccionConsultorio', 'llaveMedicoHorario', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'diponible', 'capacidad', 'created_at', 'updated_at'];
    protected $primaryKey = 'idhorarioAtencionMedico';

}
