<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_siniestro_pcl extends Model {

    protected $primaryKey = 'idSiniestroPcl';
    protected $fillable = ['llaveCanalEntrada', 'llaveQuienSolicita', 'llaveTipoSolicitud', 'llaveTipoEvento', 'fechaEvento', 'fechaCreacionCaso', 'fechaAsignacionDelCliente', 'llaveListaPrecalificacion', 'idSiniestro', 'llaveAfiliado', 'llaveEmpresaPcl', 'fechaGestion', 'otros', 'pqr', 'requiereValoracionPresencial', 'llavePrecalificacion', 'llaveCalificacion', 'llaveRecalificacion', 'llaveUsuarioQuienCrea', 'promovidoAPcl', 'created_at', 'updated_at'];

}
