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


    public function index2(Request $request)
    {
        $buscar=$request->buscar;
       

        if ($buscar=='') {
            $productos= Productos::select('productos.id','productos.nombre','productos.valor')
            ->orderBy('nombre','asc')->paginate(4);
        }else{
            $productos= Productos::select('productos.id','productos.nombre','productos.valor')
            ->where('nombre','like', '%'.$buscar.'%')
            ->orwhere('id','like', '%'.$buscar.'%')
            ->orderBy('nombre','asc')->paginate(4);
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

            'producto'=>$productos
        ];

    }

    ///////////////////////////////////////////////////////


    public function getProduc(Request $request)
    {
        $buscar=$request->buscar;
       

        
            $productos= Productos::select('productos.id','productos.nombre','productos.valor')
            ->where('nombre', 'like','%'.$buscar.'%')
            ->orwhere('id', $buscar)
            ->orderBy('nombre','asc')->take(1)->get();
  
       
        return [
            'producto'=>$productos
        ];

    }


//////////////////////////////////////

    
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
