<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\ServiceOccupation;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
    }

    public function index($id)
    {
        // if($id == auth()->user()->id){
        // }
        $servOcu=ServiceOccupation::all();
        $user = User::where('id',$id)->first();
        return view('perfil', compact( 'servOcu' , 'user' ));
    }

    public function update(Request $request){

        $usuarioLogeado = \Auth::user();

        if($usuarioLogeado->DNI!=$request->dni){
            $request->validate([
                'dni'=>'required|string|min:8|max:8|unique:users,dni',
            ]);
        }
        
        if($usuarioLogeado->email!=$request->email){
            $request->validate([
                'email'=>'required|email|unique:users,email',
            ]);
        }

        $request->validate([
            'name'=>'required',
            'lastname'=>'required|string|max:100',
            'birthdate'=>'required',
            'password'=>'required|string|max:25',
        ]);

         
            //dd($request->file('documentos_upload')->store('public'));
            $usuarioLogeado->name=$request->name;
            $usuarioLogeado->lastname=$request->lastname;
            $usuarioLogeado->DNI=$request->dni;
            $usuarioLogeado->email=$request->email;
            $usuarioLogeado->birthdate=$request->birthdate;
            $usuarioLogeado->password=bcrypt($request->password);
            $usuarioLogeado->password_confirmation=bcrypt($request->password);

        $usuarioLogeado->push();
        $message = "Realizado correctamente";
        //$id=$usuarioLogeado->id;
        return redirect()->route('perfil',Auth::user()->id)->with('updateMessage',$message);
    
    }
}
