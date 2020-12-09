<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedidos;
use App\DetallePedidos;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
     

            $pedidos= Pedidos::join('empleados','pedidos.id_empleado','=','empleados.id')
            ->select('pedidos.id','pedidos.telefono','ubicacion','estado','empleados.nomCom','empleados.id as idEmple')
            ->orderBy('id','asc')->paginate(4);
       

       
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

    public function index2(Request $request)
    {
        $buscar=$request->buscar;
       

        if ($buscar=='') {
            $pedidos= Pedidos::select('pedidos.id','pedidos.ubicacion','pedidos.telefono','pedidos.estado')
            ->orderBy('id','asc')->paginate(4);
        }else{
            $pedidos= Pedidos::select('pedidos.id','pedidos.ubicacion','pedidos.telefono','pedidos.estado')
            ->where('id','like', '%'.$buscar.'%')
            ->orderBy('id','asc')->paginate(4);
        }

       
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


    ///////////////////////////////////////////////////////


    public function getPedi(Request $request)
    {
        $buscar=$request->buscar;
       

        
            $pedidos= Pedidos::select('pedidos.id','pedidos.ubicacion','pedidos.telefono','pedidos.estado')
            ->where('id', $buscar)
            ->orderBy('id','asc')->take(1)->get();
  
       
        return [
            'pedidos'=>$pedidos
        ];

    }

    /////////////////////////////////////////////////////////////

    public function store(Request $request){
        
        try {
            DB::beginTransaction();
            $pedidos= new Pedidos();
            $pedidos->id_empleado = $request->idEmple;
            $pedidos->telefono = $request->telefono;
            $pedidos->ubicacion = $request->ubicacion;
            $pedidos->estado = $request->estadoP;
            $pedidos->save();

            $detallesP= $request->data;
            foreach ($detallesP as $key => $detP) {
                $detalle= new DetallePedidos();
                $detalle->id_pedido= $pedidos->id;
                $detalle->id_producto= $detP['id'];
                $detalle->cantidad= $detP['cantidad'];
                $detalle->precio= $detP['valor'];
                $detalle->save();

            
            }
            DB::commit();

        } catch (Exception $th) {
            DB::rollBack();
            console.log('Error', $e);
        }
    }

    
}
