<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_ep extends Model {

    protected $primaryKey = 'id_eps';
    protected $fillable = ['eps', 'nitEps', 'direccionEps', 'correoEps', 'telefonoEps', 'llaveCiudadEps', 'llaveDepartamentoEps', 'tipoEntidadEps','created_at', 'updated_at'];

}
