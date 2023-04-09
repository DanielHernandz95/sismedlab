<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_afiliado extends Model
{
       protected $primaryKey = 'idAfiliado';
      protected $fillable = ['idAfiliado','llaveTipoDocumento','documento','nombre','direccionResi','llaveDepartamento','llaveCiudad','celular','Correo','telefono','llaveGenero','estadoCivil','escolaridad','fechaNacimiento','created_at','updated_at'];
}
