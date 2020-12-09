<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleFacturas;

class DetalleFacturasController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
     

            $facturas= DetalleFacturas::join('facturas','detalle_facturas.id_factura','=','facturas.id')
            ->join('pedidos','detalle_facturas.id_pedido','=','pedidos.id')
            ->select('detalle_facturas.id_factura','detalle_facturas.id_pedido as idPedi','pedidos.ubicacion','pedidos.telefono','pedidos.estado')
            ->where('detalle_facturas.id_factura','=', $buscar)
            ->orderBy('detalle_facturas.id_pedido','asc')->paginate(4);
      

       
        return [
            'pagination'=>[
                'total'=>$facturas->total(),
                'current_page'=>$facturas->currentPage(),
                'per_page'=>$facturas->perPage(),
                'last_page'=>$facturas->lastPage(),
                'from'=>$facturas->firstItem(),
                'to'=>$facturas->lastItem(),
            ],

            'facturas'=>$facturas
        ];

    }
}
