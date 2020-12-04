<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $fillable=['id','nombre','apellido','telefono','ubicacion','correo'];
}
