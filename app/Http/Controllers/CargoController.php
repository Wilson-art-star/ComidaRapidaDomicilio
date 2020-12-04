<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargos;

class CargoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $cargos= Cargos::orderBy('nombre','asc')->paginate(4);
        }else{
            $cargos= Cargos::where($criterio,'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$cargos->total(),
                'current_page'=>$cargos->currentPage(),
                'per_page'=>$cargos->perPage(),
                'last_page'=>$cargos->lastPage(),
                'from'=>$cargos->firstItem(),
                'to'=>$cargos->lastItem(),
            ],

            'cargos'=>$cargos
        ];

    }

    
    public function store(Request $request)
    {
        //
        $cargos= new Cargos();
        $cargos->nombre = $request->nombre;
        $cargos->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $cargos= Cargos::findOrFail($request->id);
        $cargos->nombre = $request->nombre;
        $cargos->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $cargos = Cargos::findOrFail($request->id);
        $cargos->delete();
    }

    public function getCar(Request $request){
        $cargos= Cargos::orderBy('nombre','asc')->get();

        return[
            'car'=>$cargos
        ];
    }
}
