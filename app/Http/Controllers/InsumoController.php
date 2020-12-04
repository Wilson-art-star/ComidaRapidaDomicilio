<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumos;

class InsumoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $insumos= Insumos::join('tipo_insumos','insumos.id_tipo_insumo','=','tipo_insumos.id')
            ->select('insumos.id','insumos.nombre','tipo_insumos.nombre as nomTip','insumos.fecha_caducidad','insumos.valor')
            ->orderBy('nombre','asc')->paginate(4);
        }else{
            $insumos= Insumos::join('tipo_insumos','insumos.id_tipo_insumo','=','tipo_insumos.id')
            ->select('insumos.id','insumos.nombre','tipo_insumos.nombre as nomTip','insumos.fecha_caducidad','insumos.valor')
            ->where($criterio,'like', '%'.$buscar.'%')
            ->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$insumos->total(),
                'current_page'=>$insumos->currentPage(),
                'per_page'=>$insumos->perPage(),
                'last_page'=>$insumos->lastPage(),
                'from'=>$insumos->firstItem(),
                'to'=>$insumos->lastItem(),
            ],

            'insumos'=>$insumos
        ];

    }

    
    public function store(Request $request)
    {
        //
        $insumos= new Insumos();
        $insumos->nombre = $request->nombre;
        $insumos->id_tipo_insumo = $request->idTip;
        $insumos->fecha_caducidad = $request->fecha_caducidad;
        $insumos->valor = $request->valor;
        $insumos->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $insumos= Insumos::findOrFail($request->id);
        $insumos->nombre = $request->nombre;
        $insumos->id_tipo_insumo = $request->idTip;
        $insumos->fecha_caducidad = $request->fecha_caducidad;
        $insumos->valor = $request->valor;
        $insumos->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $clientes = Insumos::findOrFail($request->id);
        $clientes->delete();
    }
}
