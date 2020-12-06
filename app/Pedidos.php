<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
    
    protected $fillable=['id','id_empleado','telefono','ubicacion','estado'];

}
