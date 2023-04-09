<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_el_calificacione extends Model {

    protected $primaryKey = 'idElCalificaciones';
    protected $fillable = ['llaveEstadoElCalificacion', 'llaveUsuarioCalificadorEl', 'fechaGestionMedico','fechaSolicitudPruebas', 'fechaEnvioComiteCodess', 'fechaAvalComiteCodess','fechaRadicadoSalida', 'numeroRadicadoSalida','llaveIngresoRehabilitacion', 'llaveCanalEntradaPruebas', 'radicadoEntradaPruebas','fechaIngresoPruebas', 'fechaAsignacionMedicoCalificador','llaveOrigenOportunidadEps', 'llaveOrigenOportunidadPositiva', 'sustentacion','created_at', 'updated_at'];

}
