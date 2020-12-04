<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntradaInvemtarioInsumos;

class EntradaInventarioController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $entradainventario= EntradaInvemtarioInsumos::orderBy('hora','asc')->paginate(4);
        }else{
            $entradainventario= EntradaInvemtarioInsumos::where($criterio,'like', '%'.$buscar.'%')->orderBy('hora','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$entradainventario->total(),
                'current_page'=>$entradainventario->currentPage(),
                'per_page'=>$entradainventario->perPage(),
                'last_page'=>$entradainventario->lastPage(),
                'from'=>$entradainventario->firstItem(),
                'to'=>$entradainventario->lastItem(),
            ],

            'entradainventario'=>$entradainventario
        ];

    }

    
    public function store(Request $request)
    {
        //
        $entradainventario= new EntradaInvemtarioInsumos();
        $entradainventario->fecha_entrada = $request->fecha_entrada;
        $entradainventario->hora = $request->hora;
        $entradainventario->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $entradainventario= EntradaInvemtarioInsumos::findOrFail($request->id);
        $entradainventario->fecha_entrada = $request->fecha_entrada;
        $entradainventario->hora = $request->hora;
        $entradainventario->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $entradainventario = EntradaInvemtarioInsumos::findOrFail($request->id);
        $entradainventario->delete();
    }
}
