<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    //
    protected $fillable=['id','nombre','apellido','telefono','id_cargo','nomCom'];
}
