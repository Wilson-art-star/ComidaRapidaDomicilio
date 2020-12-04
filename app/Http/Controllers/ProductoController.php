<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;

class ProductoController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $productos= Productos::orderBy('nombre','asc')->paginate(4);
        }else{
            $productos= Productos::where($criterio,'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$productos->total(),
                'current_page'=>$productos->currentPage(),
                'per_page'=>$productos->perPage(),
                'last_page'=>$productos->lastPage(),
                'from'=>$productos->firstItem(),
                'to'=>$productos->lastItem(),
            ],

            'productos'=>$productos
        ];

    }

    
    public function store(Request $request)
    {
        //
        $productos= new Productos();
        $productos->nombre = $request->nombre;
        $productos->valor = $request->valor;
        $productos->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $productos= Productos::findOrFail($request->id);
        $productos->nombre = $request->nombre;
        $productos->valor = $request->valor;
        $productos->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $productos = Productos::findOrFail($request->id);
        $productos->delete();
    }
}
