<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_el_siniestros extends Model {

    protected $primaryKey = 'id_elSiniestro';
    protected $fillable = ['id_elSiniestro', 'llaveCanlaEntradaEl', 'llaveTipoSolicitudEl', 'llaveCovid', 'fechaRadicadoArlPositiva', 'fechaAsignacionPqr', 'llaveUsuarioAsignador', 'numeroRadicadoEntrada', 'llaveDepartramentoEl', 'llaveCiudadEl', 'numeroSiniestro', 'llaveAfiliadoEl', 'llaveEmpresaEl', 'fechaEnfermedad', 'definicionOrigenPrimeraOportunidadEps', 'definicionOrigenPrimeraOportunidadPositiva', 'llaveCalificacionEl', 'llaveCalificacionEl', 'llaveUnionCasosCuida', 'fechaCreacionSiiestroEl', 'origenCreacion', 'llaveEpsEl', 'folioEl', 'llaveCobertura', 'llaveRevicionCobertura', 'raSalidaCoBerturaDevolucionEps', 'created_at', 'updated_at'];

}
