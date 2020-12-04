<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $empleados= Empleados::join('cargos','empleados.id_cargo','=','cargos.id')
            ->select('empleados.id','empleados.nombre', 'empleados.apellido', 'empleados.telefono','cargos.nombre as nomCar')
            ->orderBy('nombre','asc')->paginate(4);
        }else{
            $empleados= Empleados::join('cargos','empleados.id_cargo','=','cargos.id')
            ->select('empleados.id','empleados.nombre', 'empleados.apellido', 'empleados.telefono','cargos.nombre as nomCar')
            ->where($criterio,'like', '%'.$buscar.'%')
            ->orderBy('nombre','asc')->paginate(4);
        }

       
        return [
            'pagination'=>[
                'total'=>$empleados->total(),
                'current_page'=>$empleados->currentPage(),
                'per_page'=>$empleados->perPage(),
                'last_page'=>$empleados->lastPage(),
                'from'=>$empleados->firstItem(),
                'to'=>$empleados->lastItem(),
            ],

            'empleados'=>$empleados
        ];

    }

    
    public function store(Request $request)
    {
        //
        $empleados= new Empleados();
        $empleados->nombre = $request->nombre;
        $empleados->apellido = $request->apellido;
        $empleados->telefono = $request->telefono;
        $empleados->id_cargo = $request->idCar;
        $empleados->save();
    }

  

   
    public function update(Request $request)
    {
        //
        $empleados= Empleados::findOrFail($request->id);
        $empleados->nombre = $request->nombre;
        $empleados->apellido = $request->apellido;
        $empleados->telefono = $request->telefono;
        $empleados->id_cargo = $request->idCar;
        $empleados->save();
    }

  
    public function destroy(Request $request)
    {
        //
        $clientes = Empleados::findOrFail($request->id);
        $clientes->delete();
    }
}