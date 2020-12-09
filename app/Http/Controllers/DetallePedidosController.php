<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetallePedidos;

class DetallePedidosController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
     

        $pedidos= DetallePedidos::join('pedidos','detalle_pedidos.id_pedido','=','pedidos.id')
        ->join('productos','detalle_pedidos.id_producto','=','productos.id')
        ->select('detalle_pedidos.id_pedido','productos.nombre as nomProducto','detalle_pedidos.cantidad','detalle_pedidos.precio')
        ->where('detalle_pedidos.id_pedido','=', $buscar)
        ->orderBy('detalle_pedidos.id_producto','asc')->paginate(4);
       

       
        return [
            'pagination'=>[
                'total'=>$pedidos->total(),
                'current_page'=>$pedidos->currentPage(),
                'per_page'=>$pedidos->perPage(),
                'last_page'=>$pedidos->lastPage(),
                'from'=>$pedidos->firstItem(),
                'to'=>$pedidos->lastItem(),
            ],

            'pedidos'=>$pedidos
        ];

    }
}
