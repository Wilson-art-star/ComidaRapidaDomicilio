<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    //
    protected $fillable=['id','nombre','id_tipo_insumo','fecha_caducidad','valor'];
}
