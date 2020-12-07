<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    

   public function login(Request $request){
       $this->validarDatos($request);
       if (Auth::attempt(['name'=>$request->usuario,'password'=>$request->password])) {
           return redirect()->route('main');
       }
       return back()
       ->withErrors(['usuario'=> trans('auth.failed')])
       ->withInput(request(['usuario']));
   }

   public function validarDatos(Request $request){

       $this->validate($request,[
           'usuario'=>'required|string',
           'password'=>'required|string'
       ]);
   }

   public function mostrarlogin(){
    return view('Auth.login');
   }
}
