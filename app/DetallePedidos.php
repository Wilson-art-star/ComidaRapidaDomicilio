<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    //
    protected $table = 'detalle_pedidos';
    protected $fillabe=['id','id_producto','id_pedido','cantidad','valor'];
}
