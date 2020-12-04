<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;

class ClienteControlles extends Controller
{
    
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $clientes= Clientes::orderBy('nombre','asc')->paginate(4);
        }else{
            $clientes= Clientes::where($criterio,'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$clientes->total(),
                'current_page'=>$clientes->currentPage(),
                'per_page'=>$clientes->perPage(),
                'last_page'=>$clientes->lastPage(),
                'from'=>$clientes->firstItem(),
                'to'=>$clientes->lastItem(),
            ],

            'clientes'=>$clientes
        ];

    }

    
    public function store(Request $request)
    {
        //
        $clientes= new Clientes();
        $clientes->nombre = $request->nombre;
        $clientes->apellido = $request->apellido;
        $clientes->ubicacion = $request->ubicacion;
        $clientes->telefono = $request->telefono;
        $clientes->correo = $request->correo;
        $clientes->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $clientes= Clientes::findOrFail($request->id);
        $clientes->nombre = $request->nombre;
        $clientes->apellido = $request->apellido;
        $clientes->ubicacion = $request->ubicacion;
        $clientes->telefono = $request->telefono;
        $clientes->correo = $request->correo;
        $clientes->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $clientes = Clientes::findOrFail($request->id);
        $clientes->delete();
    }
}
