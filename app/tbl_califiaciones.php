<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_califiaciones extends Model
{
        protected $primaryKey = 'idCalifiacion';
    protected $fillable = ['llaveCalificadorCalifiacion','llaveEstadoCalificacion','llaveSubEstadoCalificacion','fechaSolicitudAnexosCalifiacion','procentajePcl','fechaCierreCaso','fechaEnvioComite','fechaDevolucionComite','fechaVisado','fechaSolicitudAnexosCali' ,'anexoCalificacion' ,'fechaSeguimientoAnexosCal' ,'correoEnvidoCali','fechaRecepcionAnexosCal' ,'habilitado','created_at','updated_at'];

}
