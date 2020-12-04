<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoInsumos;

class TipoInsumoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $tipoinsumo= TipoInsumos::orderBy('nombre','asc')->paginate(4);
        }else{
            $tipoinsumo= TipoInsumos::where($criterio,'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$tipoinsumo->total(),
                'current_page'=>$tipoinsumo->currentPage(),
                'per_page'=>$tipoinsumo->perPage(),
                'last_page'=>$tipoinsumo->lastPage(),
                'from'=>$tipoinsumo->firstItem(),
                'to'=>$tipoinsumo->lastItem(),
            ],

            'tipoinsumo'=>$tipoinsumo
        ];

    }

    
    public function store(Request $request)
    {
        //
        $tipoinsumo= new TipoInsumos();
        $tipoinsumo->nombre = $request->nombre;
        $tipoinsumo->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $tipoinsumo= TipoInsumos::findOrFail($request->id);
        $tipoinsumo->nombre = $request->nombre;
        $tipoinsumo->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $tipoinsumo = TipoInsumos::findOrFail($request->id);
        $tipoinsumo->delete();
    }

    public function getTip(Request $request){
        $tipoinsumo= TipoInsumos::orderBy('nombre','asc')->get();

        return[
            'tip'=>$tipoinsumo
        ];
    }
}
