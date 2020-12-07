<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFacturas extends Model
{
    //
    protected $table = 'detalle_facturas';
    protected $fillabe=['id','id_factura','id_pedido'];
}
