<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_empresa extends Model {

    protected $primaryKey = 'id_empresa';
    protected $fillable = ['id_empresa','llave_tipo_docuemtno','nittEmpresa','razon_social_empleador','llave_sector','llave_departamento','llave_calificacion','otro_empresa','correotEmpresa','carasteristicas','direcciontEmpresa','created_at', 'updated_at'];

}
