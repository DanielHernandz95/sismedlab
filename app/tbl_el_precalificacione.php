<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_el_precalificacione extends Model
{
   protected $primaryKey = 'idElPrecalificacion';
    protected $fillable = ['llaveUsuarioPrecalificacionEl','llaveTipoEventoReportadoEl','fechaAsignacionEl','cargoAseguradoEl','descripcionCasoEl','llaveConceptoAfiliacionesEl',
        'llaveSolicitudPruebasEl','fechaSolicitudPruebas','llaveCanalEnvio','llaveReinteracionPruebasEl','llaveCanalReinteracionPruebasEl','fechaReinteracionPruebasEl',
        'llaveAltoCostoUciMortalEL','llaveMarcacionIsarlEl','llaveSectorEl','seguimiento','llaveCalificacionPrimeraOportunidadEpsArl','cambioFechaSiniestroIndemnizaciones',
        'escalaCasaMatriz','creacionEspecialSiniestroDx','furatFuret','certificacion','laboratorio','historiaClinica','consentimiento','otros','observacionesPreCalificacion','llaveEstadoGestionEl','llaveSubEstadoGestionEl','created_at','updated_at'];
}
