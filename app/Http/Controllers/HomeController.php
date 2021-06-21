<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function nuevoRegistro(Request $request){

        /*$request->validate([
            'nombre'=>'required',
            'apellido'=>'required|string|max:100',
            'dni'=>'required|string|min:9',
            'edad'=>'required|string|max:4',
            'sexo'=>'required',
            'usuario'=>'required|string|max:25',
            'contraseña'=>'required|string|min:6'
        ]);*/
        
        //if($contraRepetida != $request->contra){
        //    return back()->with('mensaje','Contraseñas no coinciden');
        //}


        $user = new User(array(
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'DNI' => $request->get('dni'),
            'email' => $request->get('email'),
            'birthdate' => $request->get('birthdate'),
            'password' => bcrypt($request->get('password')),
            'password_confirmation' => $request->get('password_confirmation')
        ));

        $user->save();

        return redirect()->back();
        

    }
}
