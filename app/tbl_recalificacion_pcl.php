<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_recalificacion_pcl extends Model {

    protected $primaryKey = 'idRecalificacionPcls';
    protected $fillable = ['fechaAsigProfesionalRecali','llaveCalificadorRecalificacion','llaveEstadoRecalificacion','llaveSubEstadoRecalificacion','llaveTipoEventoRecali','fechaDictamenCalificacion','numeroDictamen','dxCalidicadosPcl','entidadCalificaPcl', 'porcentajePclRecalificacion','fechaEnvioComiteRecalificacion','fechaVisadoRecalificacion','fechaDevolcionComiteRecalificacion','formatoNegacionRecalificacion','cartaNegacionRecalificacion','numeroRadicacoSalida','fechaGestion','fechaSolicitudAnexosRecali','anexoReCalificacion','fechaRecepcionAnexosReCali','fechaSeguimientoAnexosRe','correoEnvidoRecali','habilitaReca','created_at','updated_at'];
}
