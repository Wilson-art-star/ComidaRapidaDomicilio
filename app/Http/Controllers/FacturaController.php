<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facturas;
use App\DetalleFacturas;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
     

        if ($buscar=='') {
            $facturas= Facturas::orderBy('id_cliente','asc')->paginate(4);
        }else{
            $facturas= Facturas::where('ubicacion','like', '%'.$buscar.'%')->orderBy('ubicacion','asc')->paginate(4);
        }

       
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

    public function store(Request $request){
        
        try {
            DB::beginTransaction();
            $facturas= new Facturas();
            $facturas->id_cliente = $request->idClin;    
            $facturas->total = $request->totalF;
            $facturas->save();

            $detallesF= $request->data;
            foreach ($detallesF as $key => $detF) {
                $detalle= new DetalleFacturas();
                $detalle->id_factura= $facturas->id;
                $detalle->id_pedido= $detF['id'];
                $detalle->save();

            
            }
            DB::commit();

        } catch (Exception $th) {
            DB::rollBack();
            console.log('Error', $e);
        }
    }
}
